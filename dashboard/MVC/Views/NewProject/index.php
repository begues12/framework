<?php

// New Project Page

require_once  $Config->get('ROOT_HTML')."H1.php";
require_once  $Config->get('ROOT_HTML')."Img.php";
require_once  $Config->get('ROOT_HTML')."P.php";
require_once  $Config->get('ROOT_HTML')."OtherElement.php";
require_once  $Config->get('ROOT_HTML')."Div.php";
require_once  $Config->get('ROOT_HTML')."Input.php";
require_once  $Config->get('ROOT_HTML')."Form.php";

require_once  $Config->get('ROOT_WIDGETS')."Carousel.php";

use Engine\Utils\HTML\H1;
use Engine\Utils\HTML\Img;
use Engine\Utils\HTML\P;
use Engine\Utils\HTML\OtherElement;
use Engine\Utils\HTML\Div;
use Engine\Utils\HTML\Input;
use Engine\Utils\HTML\Form;
use Engine\Utils\Widgets\Carousel;

$Content = new Div();

$Content->class = "content p-5";

$Title = new H1();

$Title->text = "New Project";

$Content->Add($Title);

$Content_form_carousel = new Div();
$Content_form_carousel->class = "row d-flex justify-content-center";

$Content_Form = new Div();
$Content_Form->class = "col-md-5 d-inline align-items-center";
$Content_Form->id = "content-form";

$Form = new Form();
// Before request form jquery validation
$Form->id = "form-new-project";
$Form->method = "POST";

$Input_name = new Input();
$Input_name->type = "text";
$Input_name->name = "NewProjectName";
$Input_name->id = "name";
$Input_name->placeholder = "Project Name";
$Input_name->class = "form-control m-2";

$Input_description = new Input();
$Input_description->type = "text";
$Input_description->name = "description";
$Input_description->id = "description";
$Input_description->placeholder = "Project Description";
$Input_description->class = "form-control m-2";

$Input_submit = new Input();
$Input_submit->id = "submit-new-project";
$Input_submit->type = "button";
$Input_submit->value = "Create Project";
$Input_submit->class = "btn btn-primary m-2";

$Form->Add($Input_name);
$Form->Add($Input_description);
$Form->Add($Input_submit);

$Content_Form->Add($Form);

$Content_form_carousel->Add($Content_Form);

$Carousel = new Carousel();
$Carousel->class = "col-md-5 d-inline align-items-center carousel slide";

$Img = new Img();
//Placeholder image
$Img->src = "https://www.comparapps.com/wp-content/uploads/2020/03/imagenes-para-paginas-web.png";
$Img->class = "img-fluid d-block w-100";
$Carousel->AddImage($Img, false);

$Img = new Img();
$Img->src = "https://www.comparapps.com/wp-content/uploads/2020/03/imagenes-para-paginas-web.png";
$Img->class = "img-fluid d-block w-100";
$Carousel->AddImage($Img, true);

$Img = new Img();
$Img->src = "https://www.comparapps.com/wp-content/uploads/2020/03/imagenes-para-paginas-web.png";
$Img->class = "img-fluid d-block w-100";

$Carousel->AddImage($Img);

$Content_form_carousel->Add($Carousel);

$Content->Add($Content_form_carousel);

$Content->render();




?>
