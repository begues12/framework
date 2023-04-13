<?php

#Namespace of button class as defined in \\Engine\Utils\Button.php
require_once "Engine\Utils\HTML\Button.php";
require_once "Engine\Utils\HTML\Input.php";
require_once "Engine\Utils\HTML\TextArea.php";
require_once "Engine\Utils\HTML\Form.php";
require_once "Engine\Utils\HTML\Option.php";
require_once "Engine\Utils\HTML\Select.php";
require_once "Engine\Utils\HTML\Tr.php";
require_once "Engine\Utils\HTML\Td.php";
require_once "Engine\Utils\HTML\Table.php";
require_once "Engine\Utils\HTML\Image.php";
require_once "Engine\Utils\HTML\Div.php";
require_once "Engine\Utils\HTML\Label.php";

//Import Navbar
require_once "Engine\Utils\Widgets\Navbar.php";

use Engine\Utils\HTML\Button;
use Engine\Utils\HTML\Input;
use Engine\Utils\HTML\TextArea;
use Engine\Utils\HTML\Form;
use Engine\Utils\HTML\Option;
use Engine\Utils\HTML\Select;
use Engine\Utils\HTML\Tr;
use Engine\Utils\HTML\Td;
use Engine\Utils\HTML\Table;
use Engine\Utils\HTML\Image;
use Engine\Utils\HTML\Div;
use Engine\Utils\HTML\Label;
use Engine\Utils\Widgets\Navbar;

$button = new Button();
$button->type = "submit";
$button->name = "save";
$button->value = "save";
$button->text = "Save";
$button->class = "btn btn-primary";
$button->id = "saveButton";


$input = new Input();
$input->name = "name";
$input->value = "name";

$textArea = new TextArea();
$textArea->name = "description";
$textArea->value = "description";
$textArea->css = ['width' => '100%', 'height' => '100px'];

$form = new Form();
$form->action = "index.php";
$form->method = "get";
$form->class = "form-group";
$form->id = "form";



$select = new Select();
$select->name = "select";
$select->class = "form-control";
$select->id = "select";

$option = new Option();
$option->value = "1";
$option->text = "Option 1";
$option->selected = false;

$option2 = new Option();
$option2->value = "2";
$option2->text = "Option 2";
$option2->selected = true;

$select->Add($option);
$select->Add($option2);

$form->Add($input);
$form->Add($textArea);
$form->Add($select);
$form->Add($button);

$div = new Div();
$div->class = "form-group";
$div->id = "div";
$div->css = ['width' => '100%', 'height' => '100px', 'border' => '1px solid #ddd', 'margin' => '10px'];

$div->Add($form);

$div->render();

$table = new Table();
$table->class = "table table-striped table-bordered table-hover";
$table->id = "table";
$table->setCss(['width' => '100%', 'border-collapse' => 'collapse', 'border' => '1px solid #ddd']);

$tr = new Tr();
$tr->class = "odd gradeX";
$tr->id = "tr";

$td = new Td();
$td->class = "center";
$td->id = "td";
$td->text = "test";

$tr->Add($td);
$tr->Add($td);
$tr->Add($td);
$table->Add($tr);
$table->Add($tr);

$table->render();

$image = new Img();
$image->src = "https://www.google.com/images/branding/googlelogo/2x/googlelogo_color_272x92dp.png";
$image->alt = "Google Logo";
$image->class = "img-responsive";
$image->id = "image";
$image->render();

$radio = new Input();
$radio->type = "radio";
$radio->name = "radio";
$radio->value = "radio";
$radio->class = "radio";
$radio->id = "radio";

$label = new Label();
$label->for = "radio";
$label->text = "Radio 1";
$radio->Add($label);
$radio->render();

$radio2 = new Input();
$radio2->type = "radio";
$radio2->name = "radio";

$label = new Label();
$label->for = "radio2";
$label->text = "Radio 2";

$radio2->Add($label);

$radio2->value = "radio2";
$radio2->class = "radio";
$radio2->id = "radio2";
$radio2->render();

$checkbox = new Input();
$checkbox->type = "checkbox";
$checkbox->name = "checkbox";
$checkbox->value = "checkbox";
$checkbox->class = "checkbox";
$checkbox->id = "checkbox";
$checkbox->render();

?>
