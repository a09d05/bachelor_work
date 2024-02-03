<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use ZipArchive;
use mysqli;

class WordController extends AbstractController
{
    #[Route('/word', name: 'app_word')]
    public function index(): Response
    {
        return $this->render('word/index.html.twig', [
            'controller_name' => 'WordController',
        ]);
    }

    /**
    * @Route("/", name="homepage")
    */
    #[Route('/word_download', name: 'app_word_load')]
    public function indexAction(): Response
    {
        // Create a new Word document
        $phpWord = new PhpWord();

        /* Note: any element you append to a document must reside inside of a Section. */

        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $section = $phpWord->addSection();
        $header = ['size' => 16, 'bold' => true];

       $section->addTextBreak(1);
        $section->addText('Отчет по проверкам отделов в области охраны труда', $header);

        $fancyTableStyleName = 'Fancy Table';
        $fancyTableStyle = ['borderSize' => 6, 'borderColor' => '006699', 'cellMargin' => 80, 'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER, 'cellSpacing' => 50];
        $fancyTableFirstRowStyle = ['borderBottomSize' => 18, 'borderBottomColor' => '0000FF', 'bgColor' => '66BBFF'];
        $fancyTableCellStyle = ['valign' => 'center'];
        $fancyTableCellBtlrStyle = ['valign' => 'center', 'textDirection' => \PhpOffice\PhpWord\Style\Cell::TEXT_DIR_TBRL];
        $fancyTableFontStyle = ['bold' => true];
        
        $phpWord->addTableStyle($fancyTableStyleName, $fancyTableStyle, $fancyTableFirstRowStyle);
        $table = $section->addTable($fancyTableStyleName);
        $table->addRow(900);
        $table->addCell(1000, $fancyTableCellStyle)->addText('Фамилия проверяющего', $fancyTableFontStyle);
        $table->addCell(1000, $fancyTableCellStyle)->addText('Проверяемый отдел', $fancyTableFontStyle);
        $table->addCell(1000, $fancyTableCellStyle)->addText('План.дата', $fancyTableFontStyle);
        $table->addCell(1000, $fancyTableCellStyle)->addText('Факт.дата', $fancyTableFontStyle);
        $table->addCell(1000, $fancyTableCellStyle)->addText('Результат', $fancyTableFontStyle);
        $table->addCell(1000, $fancyTableCellStyle)->addText('Комментарий', $fancyTableFontStyle);

        $conn = new mysqli("localhost", "root", "N28,rty5", "app");
        $conn->set_charset("utf8mb4");
        if($conn->connect_error){
            die("Ошибка: " . $conn->connect_error);
        }

        $sql = "SELECT employee.surname AS 'Фамилия проверяющего',
                depts.dept_name AS 'Проверяемый отдел',
                check_requirements_work.planned_check_date AS 'План. дата',
                check_requirements_work.fact_check_date AS 'Факт. дата',
                check_requirements_work.result AS 'Результат',
                check_requirements_work.comments AS 'Комментарий'
            FROM check_requirements_work
            JOIN employee ON check_requirements_work.fk_id_employee_id = employee.id
            JOIN depts ON check_requirements_work.fk_id_dept_id = depts.id";

        if($result = $conn->query($sql))
        {
            $rowsCount = $result->num_rows;
            #for ($i = 1; $i <= $rowsCount; ++$i)
            foreach($result as $row)
            {
                $table->addRow();
                $table->addCell(1000)->addText("{$row["Фамилия проверяющего"]}");
                $table->addCell(1000)->addText("{$row["Проверяемый отдел"]}");
                $table->addCell(1000)->addText("{$row["План. дата"]}");
                $table->addCell(1000)->addText("{$row["Факт. дата"]}");
                $table->addCell(1000)->addText("{$row["Результат"]}");
                $table->addCell(1000)->addText("{$row["Комментарий"]}");

                /*
                $table->addRow();
                $table->addCell(1000)->addText("Cell {$i}");
                $table->addCell(1000)->addText("Cell {$i}");
                $table->addCell(1000)->addText("Cell {$i}");
                $table->addCell(1000)->addText("Cell {$i}");
                $table->addCell(1000)->addText("Cell {$i}");
                $table->addCell(1000)->addText("Cell {$i}");
                */
            }
        }            

        // Saving the document as OOXML file...
        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');

        // Create a temporal file in the system
        $fileName = 'download_file.docx';
        $temp_file = tempnam(sys_get_temp_dir(), $fileName);

        // Write in the temporal filepath
        $objWriter->save($temp_file);

        // Send the temporal file as response (as an attachment)
        $response = new BinaryFileResponse($temp_file);
        $response->setContentDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            $fileName
        );

        return $response;
    }
}
