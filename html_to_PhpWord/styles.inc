<?php

// Example styles
// This is an example of how a "style sheet" should be structured
// to asign PHPWord styles to HTML elements, classes, and inline
// styles.
use PhpOffice\PhpWord\Style\Font;
function htmltodocx_styles_example()
{

    // Set of default styles -
    // to set initially whatever the element is:
    // NB - any defaults not set here will be provided by PHPWord.
    $styles['default'] =
        array(
            'name' => 'Verdana',
            'size' => 12,
        );


    // Element styles:
    // The keys of the elements array are valid HTML tags;
    // The arrays associated with each of these tags is a set
    // of PHPWord style definitions.
    $styles['elements'] =
        array(
            'h1' => array(
                'bold' => TRUE,
                'size' => 20,
                'color' => '1F497D',
            ),
            'red' => array(
                'bold' => true,
                'color' => 'FF0000',
            ),
            'h2' => array(
                'bold' => TRUE,
                'size' => 15,
                'color' => '1F497D',
                'spaceAfter' => 150,
            ),
            'h3' => array(
                'size' => 12,
                'bold' => TRUE,
                'color' => '1F497D',
                'spaceAfter' => 100,
            ),
            'p' => array(
                'name' => 'Verdana',
                'size' => 11,
            ),
            'li' => array(),
            'ol' => array(
                'spaceBefore' => 200,
            ),
            'ul' => array(
                'spaceAfter' => 150,
            ),
            'b' => array(
                'bold' => TRUE,
            ),
            'em' => array(
                'italic' => TRUE,
            ),
            'i' => array(
                'italic' => TRUE,
            ),
            'strong' => array(
                'bold' => TRUE,
            ),
            'b' => array(
                'bold' => TRUE,
            ),
            'sup' => array(
                'superScript' => TRUE,
                'size' => 6,
            ), // Superscript not working in PHPWord     application/libraries/html2docx/latest_phpword/PHPWord/src/PhpWord/Style/Font.php:17
            'u' => array(
                'underline' => Font::UNDERLINE_SINGLE,
            ),
            'a' => array(
                'color' => '0000FF',
                'underline' => Font::UNDERLINE_SINGLE,
            ),
            'table' => array(
                // Note that applying a table style in PHPWord applies the relevant style to
                // ALL the cells in the table. So, for example, the borderSize applied here
                // applies to all the cells, and not just to the outer edges of the table:
                'borderColor' => 'FFFFFF',
                'borderSize' => 0,
            ),
            'th' => array(
                'borderColor' => 'FFFFFF',
                'borderSize' => 0,
            ),
            'td' => array(
                'borderColor' => 'FFFFFF',
                'borderSize' => 0,
            ),

        );


    // Classes:
    // The keys of the classes array are valid CSS classes;
    // The array associated with each of these classes is a set
    // of PHPWord style definitions.
    // Classes will be applied in the order that they appear here if
    // more than one class appears on an element.
    $styles['classes'] =
        array(
            'sectionheadtable' => array(
                'borderColor' => '1F497D',
                'color' => '1F497D',
                'borderSize' => 10,
                'bgColor' => 'EFEFEF',
                'spaceBefore' => 0,
                'spaceAfter' => 0,
            ),
            'sectionheadtable1' => array (
                'borderColor' => '1F497D',
                'color' => '1F497D',
                'borderSize' => 10,
                'bgColor' => 'fabf8f',
                'spaceBefore' => 0,
                'spaceAfter' => 0,
            ),
            'gridtable' =>array(
                'gridSpan' => 2
            ),
            'gridtable4' =>array(
                'gridSpan' => 4
            ),
            'gridtable3' =>array(
                'gridSpan' => 3
            ),
            'gridtable5' =>array(
                'gridSpan' => 5
            ),
            'sectionheadtable2' => array (
                'borderColor' => '1F497D',
                'color' => '00000',
                'borderSize' => 10,
                'bgColor' => 'D1DEEE',
                'spaceBefore' => 0,
                'spaceAfter' => 0,
            ),


            'orangebottom' => array(
                'borderBottomColor' => 'F68025',
                'borderBottomSize' => 50,
            ),

            'para' => array(
                'spaceBefore' => 0,
                'spaceAfter' => 140,
            ),
            'para50' => array(
                'spaceBefore' => 0,
                'spaceAfter' => 50,
            ),
            'para2' => array(
                'size' => 8,
            ),
            'sectionhead1' => array(
                'bold' => TRUE,
                'size' => 18,
                'align' => 'center',
                'spaceBefore' => 5,
                'spaceAfter' => 5,
            ),
            'para_mid' => array(
                'align' => 'both',
                'spaceBefore' => 0,
                'spaceAfter' => 100,
            ),
            'para_small' => array(
                'align' => 'both',
                'spaceBefore' => 0,
                'spaceAfter' => 10,
            ),
            'paraheader' => array(
                'color' => '365f91',
                'borderColor' => '00000',
                'borderSize' => 10,
                'bgColor' => 'fabf8f',
                'spaceBefore' => 0,
                'spaceAfter' => 0,
            ),
            'profile' => array(
                'wrappingStyle' => 'behind',
                'wrapDistanceRight' => 0
            ),
            'tablepheadForProfile' => array(
                'spaceBefore' => 0,
                'spaceAfter' => 0,
                'size' => 10,
                'bold' => TRUE,
                'align' => 'left',
                'bgColor' => 'EFEFEF',
                'color' => '1F497D',
                'valign' => 'top',
            ),
            'tablepheadForblack' => array(
                'color' => '000',
            ),
            'textColor' => array(
                'color' => '5879A3',
            ),
            'para_mid_aoe' => array(
                'align' => 'both',
                'spaceBefore' => 0,
                'spaceAfter' => 0,
            ),

            'borderedimage' => array(
                'spaceAfter' => 40,
                'borderColor' => '000000',
                'borderSize' => 30,
            ),

            'para_nospace' => array(
                'spaceBefore' => 0,
                'spaceAfter' => 0,
            ),

            'tablesubhead' => array(
                'spaceBefore' => 0,
                'spaceAfter' => 0,
            ),

            'tdsubhead' => array(
                'size' => '16',
                'align' => 'left',
                'bold' => true,
                'borderBottomColor' => '000000',
                'borderBottomSize' => 10,
            ),

            'tablehead' => array(
                'bgColor' => 'EFEFEF',
                'color' => '1F497D',
                'valign' => 'top',
                'align' => 'right',
            ),

            'tablecontent' => array(
                'valign' => 'top',
                'align' => 'left',
            ),

            'tablephead' => array(
                'spaceBefore' => 0,
                'spaceAfter' => 0,
                'size' => 10,
                'bold' => TRUE/*,
                'align' => 'center',*/
            ),

            'tablepcontent' => array(
                'spaceBefore' => 0,
                'spaceAfter' => 0,
                'size' => 10,
            ),

            'sectionhead' => array(
                'bold' => TRUE,
                'size' => 18,
                'align' => 'center',
                'spaceBefore' => 30,
                'spaceAfter' => 5,
            ),
            'sectionheadForPerformance' => array(
                'bold' => TRUE,
                'size' => 12,
                'align' => 'center',
                'spaceBefore' => 0,
                'spaceAfter' => 0,
            ),

            'underline' => array(
                'underline' => Font::UNDERLINE_SINGLE,
            ),
            'alignright' => array(
                'align' => 'right',
            ),
            'phead' => array(
                'spaceAfter' => 15,
                'color' => '04477F',
                'size' => '8',
            ),

            'big_title' => array(
                'size' => 30,
                'bold' => TRUE,
                'align' => 'center',
                'spaceAfter' => 50,
                'name' => 'Verdana',
            ),
            'big_subtitle' => array(
                'size' => 24,
                'italic' => TRUE,
                'bold' => TRUE,
                'align' => 'center',
                'name' => 'Verdana',
            ),

            'invest_footer' => array(
                'size' => 14,
                'align' => 'center',
                'spaceAfter' => 20,
            ),
            'footer' => array(
                'size' => 14,
                'align' => 'center',
                'spaceAfter' => 0,
            ),

            'bordered' => array(
                'borderColor' => '000000',
                'borderSize' => 10,
            ),

            'lightbordered' => array(
                'borderColor' => '999999',
                'borderSize' => 10,
            ),

            'red' => array(
                'bold' => true,
                'color' => 'FF0000',
            ),

            'female' => array(
                'bold' => true,
                'color' => 'ff3399',
            ),
            'male' => array(
                'bold' => true,
                'color' => '0070c0',
            ),

            'fs8' => array(
                'size' => 8,
            ),

            'fs12' => array(
                'size' => 12,
            ),
            'fs10' => array(
                'size' => 10,
            ),

            'fs14' => array(
                'size' => 14,
            ),

            'fs16' => array(
                'size' => 16,
            ),

            'fs22' => array(
                'size' => 22,
            ),

            'fwn' => array(
                'bold' => false,
            ),

            'fb' => array(
                'bold' => true,
            ),
            'ftimesRoman' => array(
                'name' => 'Times New Roman',
                'size' => 12,
            ),

            'down_opacity'=>array(
                'color' => 'dddddd'
            ),
            'imgBackground'=>array(
                'wrappingStyle'=>'behind'
            ),
            'tableBorderForUlLi' => array (
                'borderColor' => 'f7f6f7'
            ),
            'singleBorder' => array(
                'borderBottomColor'=>'FFFFFF',
                'borderLeftColor'=>'FFFFFF',
                'borderRightColor'=>'FFFFFF',
                'borderToColor'=>'FFFFFF',
                'borderSize' => 10,
                'spaceBefore' => 0,
                'spaceAfter' => 0,
            ),
            'Esispara' => array(
                'spaceBefore' => 0,
                'spaceAfter' => 150,
            ),
            'HNewsGEuro' => array(
                'name' => 'News Gothic Euro',
                'size' => 14,
                'color'=> '3A5959',
            ),
            'EsisftimesRoman' => array(
//                'name' => 'Times New Roman',
                'name' => 'Verdana',
                'size' => 11,
            ),
        );


    // Inline style definitions, of the form:
    // array(css attribute-value - separated by a colon and a single space => array of
    // PHPWord attribute value pairs.
    $styles['inline'] =
        array(
            'text-decoration: underline' => array(
                'underline' => Font::UNDERLINE_SINGLE,
            ),
            'font-size: 9px' => array(
                'size' => '9',
            ),
            'font-size: 12px' => array(
                'size' => '12',
            ),
            'vertical-align: left' => array(
                'valign' => 'left',
            ),
            'vertical-align: middle' => array(
                'valign' => 'center',
            ),
            'vertical-align: right' => array(
                'valign' => 'right',
            ),
            'text-align: left' => array(
                'align' => 'left',
            ),
            'text-align: center' => array(
                'align' => 'center',
            ),
            'text-align: right' => array(
                'align' => 'right',
            ),
            'text-align: justify' => array(
                'align' => 'both',
            )
        );

    return $styles;
}