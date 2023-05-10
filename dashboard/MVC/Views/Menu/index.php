<?php

require_once $Config->get('ROOT_HTML')."Div.php";
require_once $Config->get('ROOT_HTML')."H1.php";
require_once $Config->get('ROOT_HTML')."P.php";
require_once $Config->get('ROOT_HTML')."Ul.php";
require_once $Config->get('ROOT_HTML')."Li.php";
require_once $Config->get('ROOT_HTML')."Img.php";
require_once $Config->get('ROOT_HTML')."Label.php";

use Engine\Utils\HTML\Div;
use Engine\Utils\HTML\H1;
use Engine\Utils\HTML\P;
use Engine\Utils\HTML\Ul;
use Engine\Utils\HTML\Li;
use Engine\Utils\HTML\Img;
use Engine\Utils\HTML\Label;

$Content = new Div();

// Strawberry page
$Content->class = "container";
$Content->id = "strawberry-page";

// Add a header
$Header = new Div();
$Header->class = "row";

$Title = new H1();
$Title->class = "text-center";
$Title->text = "Introducing Strawberry";

$Header->Add($Title);

$Content->Add($Header);

// Add a section about the benefits of using Strawberry
$BenefitsSection = new Div();
$BenefitsSection->class = "row my-5";

$BenefitsTitle = new H1();
$BenefitsTitle->class = "col-12 mb-4";
$BenefitsTitle->text = "Benefits of using Strawberry";

$BenefitsList = new Ul();
$BenefitsList->class = "col-12";

$Benefit1 = new Li();
$Benefit1->text = "Easy to use and customize";

$Benefit2 = new Li();
$Benefit2->text = "Fast and lightweight";

$Benefit3 = new Li();
$Benefit3->text = "Cross-platform support";

$BenefitsList->Add($Benefit1);
$BenefitsList->Add($Benefit2);
$BenefitsList->Add($Benefit3);

$BenefitsSection->Add($BenefitsTitle);
$BenefitsSection->Add($BenefitsList);

$Content->Add($BenefitsSection);

// Add a section about the features of Strawberry
$FeaturesSection = new Div();
$FeaturesSection->class = "row my-5";

$FeaturesTitle = new H1();
$FeaturesTitle->class = "col-12 mb-4";
$FeaturesTitle->text = "Features of Strawberry";

$FeaturesList = new Ul();
$FeaturesList->class = "col-12";

$Feature1 = new Li();
$Feature1->text = "Responsive design";

$Feature2 = new Li();
$Feature2->text = "Flexible layout options";

$Feature3 = new Li();
$Feature3->text = "Built-in UI components";

$FeaturesList->Add($Feature1);
$FeaturesList->Add($Feature2);
$FeaturesList->Add($Feature3);

$FeaturesSection->Add($FeaturesTitle);
$FeaturesSection->Add($FeaturesList);

$Content->Add($FeaturesSection);

// Add an image of Strawberry in action
$ImageSection = new Div();
$ImageSection->class = "row my-5";

$ImageTitle = new H1();
$ImageTitle->class = "col-12 mb-4";
$ImageTitle->text = "Strawberry in action";

$Image = new Img();
$Image->src = "https://via.placeholder.com/800x600";
$Image->alt = "Strawberry in action";
$Image->class = "col-12";

$ImageSection->Add($ImageTitle);
$ImageSection->Add($Image);

$Content->Add($ImageSection);

// Add a section about getting started with Strawberry
$GettingStartedSection = new Div();

$GettingStartedTitle = new H1();

$GettingStartedTitle->class = "h1 col-12 mb-4";

$GettingStartedTitle->text = "Getting started with Strawberry";

$GettingStartedSection->Add($GettingStartedTitle);

$GettingStartedSection->class = "row my-5";

$GettingStartedList = new Ul();

$GettingStartedList->class = "col-12";

$GettingStarted1 = new Li();

$GettingStarted1->text = "Download Strawberry";

$GettingStarted2 = new Li();

$GettingStarted2->text = "Install Strawberry";

$GettingStarted3 = new Li();

$GettingStarted3->text = "Start using Strawberry";

$GettingStartedList->Add($GettingStarted1);

$GettingStartedList->Add($GettingStarted2);

$GettingStartedList->Add($GettingStarted3);

$GettingStartedSection->Add($GettingStartedList);

$Content->Add($GettingStartedSection);

// Add a section about the future of Strawberry

$FutureSection = new Div();

$FutureTitle = new H1();

$FutureTitle->class = "h1 col-12 mb-4";

$FutureTitle->text = "The future of Strawberry";

$FutureSection->Add($FutureTitle);

$FutureSection->class = "row my-5";

$FutureList = new Ul();

$FutureList->class = "col-12";

$Future1 = new Li();

$Future1->text = "Add more features";

$Future2 = new Li();

$Future2->text = "Add more components";

$Future3 = new Li();

$Future3->text = "Add more themes";

$FutureList->Add($Future1);

$FutureList->Add($Future2);

$FutureList->Add($Future3);

$FutureSection->Add($FutureList);

$Content->Add($FutureSection);

// Add a section about the license of Strawberry

$LicenseSection = new Div();

$LicenseTitle = new H1();

$LicenseTitle->class = "h1 col-12 mb-4";

$LicenseTitle->text = "License";

$LicenseSection->Add($LicenseTitle);

$LicenseSection->class = "row my-5";

$LicenseList = new Ul();

$LicenseList->class = "col-12";

$License1 = new Li();

$License1->text = "Strawberry is licensed under the MIT license";

$License2 = new Li();

$License2->text = "Strawberry is free to use for personal and commercial projects";

$License3 = new Li();

$License3->text = "Strawberry is free to modify and redistribute";

$LicenseList->Add($License1);

$LicenseList->Add($License2);

$LicenseList->Add($License3);

$LicenseSection->Add($LicenseList);

$Content->Add($LicenseSection);

// Add a section about the contributors of Strawberry

$ContributorsSection = new Div();

$ContributorsTitle = new H1();

$ContributorsTitle->class = "h1 col-12 mb-4";

$ContributorsTitle->text = "Contributors";

$ContributorsSection->Add($ContributorsTitle);

$ContributorsSection->class = "row my-5";

$ContributorsList = new Ul();

$ContributorsList->class = "col-12";

$Contributor1 = new Li();

$Contributor1->text = "John Doe";

$Contributor2 = new Li();

$Contributor2->text = "Jane Doe";

$Contributor3 = new Li();

$Contributor3->text = "John Smith";

$ContributorsList->Add($Contributor1);

$ContributorsList->Add($Contributor2);

$ContributorsList->Add($Contributor3);

$ContributorsSection->Add($ContributorsList);

$Content->Add($ContributorsSection);

$Content->render();

?>