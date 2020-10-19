<?php

error_reporting(-1);
ini_set('display_errors', 1);
$errorArray=[];
if(!is_dir('tmp/')){
    $errorArray[]= "tmp directory not exists";
}elseif (!is_writable(getcwd()."/tmp/")) {
    $errorArray[] = "'tmp' directory is not writable.";
}
if(!extension_loaded('zip')){
    $errorArray[]= "'ZIP' PHP extensions not found";
}

if(!extension_loaded('simplexml')){
    $errorArray[]= "'xml' PHP extensions not found";
}
if(!extension_loaded('mbstring')){
    $errorArray[]= "'mbstring' PHP extensions not found";
}
if(!extension_loaded('gd')){
    $errorArray[]= "'GD\|ImageMagick' PHP extensions not found";
}
if (count($errorArray) > 0) {
    ?>
    <div style="color: red;text-align: left;">
    <strong>Error !</strong><br> <?= implode('<br>', $errorArray) ?>
    </div><?php
    exit(); // EXIT_ERROR
}
require_once "vendor/autoload.php";

$html2docx=new html2docx();

$Company['Address']="How do I get Lorem Ipsum text?";
$Company['Address2']=" dummy text?";
$Company['City']="People";
$Company['Zip']= "133654";
$Company['Phone']='1236547895';
$Company['AlternatePhone']='1236547895';
$Company['Toll-free']='1236547895';

addReportHeaderAndFooter($Company,$html2docx);



$html2docx->convertHTML(file_get_contents('html.php'), "Simple_docx_files.docx");





function addReportHeaderAndFooter($Company, &$html2docx) {
    //get PHPWord object
    $section = $html2docx->getPHPWordSection();

    $logoname = 'img/images.png';


    $fhead = array(
        'name' => 'Verdana',
        'color' => '04477F',
        'size' => '8',
    );
    $phead = array(
        'spaceAfter' => 10,
        'align'=>'right',
    );
    $header = $section->createHeader();
    $table = $header->addTable();
    $table->addRow();
    $table->addCell(4500 , array(
        'borderBottomColor' => 'F68025',
        'borderBottomSize' => 50,
    ))
        ->addImage(($logoname), array(
            'width'=>190,
            'height'=>60,
            'align'=>'left',
        ));
    $cell = $table->addCell(4500 , array(
        'borderBottomColor' => 'F68025',
        'borderBottomSize' => 50,
    ));

    $cell->addText( $Company['Address'] . ' ' . $Company['Address2'] , $fhead , $phead);
    $cell->addText( $Company['City'] . ', ' . $Company['City'] . ' ' . $Company['Zip'] , $fhead , $phead);
    $cell->addText( 'Phone ' . formatPhone($Company['AlternatePhone']) , $fhead , $phead);
    $cell->addText( 'Toll-free ' . formatPhone($Company['Phone']) , $fhead , $phead);


    //footer
    $footer = $section->createFooter();
    $footer->addPreserveText('Page | {PAGE}', array('bold'=>true , 'name'=>'Verdana') , array('align'=>'center' , 'spaceBefore' => 120));
    $footer->addText('What is Lorem Ipsum Lorem Ipsum is simply dummy text of the printing and typesetting industry Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s when an unknown printer took a galley of type and scrambled it to make a type specimen book it has?', array('name'=>'Verdana' , 'size'=>8 , 'color'=>'FF6C23') , array('align'=>'both' , 'spaceBefore' => 60));
}
function formatPhone( $p ) {
    if (empty($p) || ($p == '--') || ($p == '---'))
        return '';

    $value = explode("-", $p);

    $val = (isset($value[0]) ? '(' . $value[0] . ') ' : '') . (isset($value[1]) ? $value[1] : '') . '-' . (isset($value[2]) ? $value[2] : '');

    if (isset($value[3]) && !empty($value[3]))
        $val .=  ' - ext. ' . $value[3];

    return $val;
}