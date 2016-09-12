<?php
session_start();
unset($_SESSION);
$_SESSION['data']['ide']['nom'] = "BILLETTE";
$_SESSION['data']['ide']['pre'] = "Benjamin";
$_SESSION['data']['ide']['adr'] = "17 rue Capron";
$_SESSION['data']['ide']['cod'] = "75018";
$_SESSION['data']['ide']['vil'] = "PARIS";
$_SESSION['data']['ide']['dat'] = "26/03/1987";

$_SESSION['data']['tit'] = "D�veloppeur Web";
$_SESSION['data']['obj'] = "Actuellement � la recherche d'un emploi, je me permets de vous faire parvenir cette candidature pour un poste au sein de votre �quipe.";

$_SESSION['data']['exp'][0] = array(
	'datedebut' => '01/01/2016',
	'datefin' => '31/12/2016',
	'prequoi' => 'Cisp',
	'nomou' => 'ML SEINOISE',
	'ville' => 'DEUIL',
	'codedep' => '95170'
	);

$_SESSION['data']['exp'][1] = array(
	'datedebut' => '01/01/2016',
	'datefin' => '31/12/2016',
	'prequoi' => 'Cisp',
	'nomou' => 'ML SEINOISE',
	'ville' => 'DEUIL',
	'codedep' => '95170'
	);

$_SESSION['data']['exp'][2] = array(
	'datedebut' => '01/01/2016',
	'datefin' => '31/12/2016',
	'prequoi' => 'Cisp',
	'nomou' => 'ML SEINOISE',
	'ville' => 'DEUIL',
	'codedep' => '95170'
	);
	
	
$_SESSION['data']['for'][0] = array(
	'datedebut' => '01/01/2016',
	'datefin' => '31/12/2016',
	'prequoi' => 'D�veloppeur Web',
	'nomou' => 'CNAM',
	'ville' => 'PARIS',
	'codedep' => '75000'
	);

$_SESSION['data']['for'][1] = array(
	'datedebut' => '01/01/2016',
	'datefin' => '31/12/2016',
	'prequoi' => 'Cisp',
	'nomou' => 'ML SEINOISE',
	'ville' => 'DEUIL',
	'codedep' => '95170'
	);

$_SESSION['data']['for'][2] = array(
	'datedebut' => '01/01/2016',
	'datefin' => '31/12/2016',
	'prequoi' => 'Cisp',
	'nomou' => 'ML SEINOISE',
	'ville' => 'DEUIL',
	'codedep' => '95170'
	); 

$_SESSION['data']['inf']['lan'] = "Langues : Anglais (bon niveau), Allemand (niveau scolaire)";
$_SESSION['data']['inf']['loi'] = "Loisirs : musique, �criture";

//params :
// tailles :
$taille_coordos = 16;
$taille_titre = 30;
$taille_ss_titre = 14;
$taille_bandeaux = 16;
$taille_texte = 12;

//espaces :
$espaces_g = 6;
//$espace_coordos_titre = 10;

//polices :
$polices = array('Arial', 'Times', 'Courier');

require('fpdf.php');

class PDF extends FPDF
{

function AjouterRu($rub, $espaces_g, $taille_b) // faire un h�ritage ou un trait... � voir demain !!!
{
	$this->Ln($espaces_g);
	$this->SetFont('Arial','B',$taille_b);
	$this->SetTextColor(255,255,255);
	$this->SetFillColor(0,0,0);
	$this->Cell(0,10,$rub,1,1,'C',true);
	// Saut de ligne
	$this->Ln(1);
	$this->SetTextColor(0,0,0);
}

function AjouterItem($quand, $quoi, $ou, $taille_t)
{
	$this->Ln(4);
	$this->SetFont('Arial','',$taille_t);
	$this->Cell(85,8,$quand,0,0);
	$this->SetFont('Arial','B',$taille_t+2);
	$this->Cell(0,8,$quoi,0,1);
	$this->SetFont('Arial','',$taille_t);
	$this->Cell(85,8,'',0,0);
	$this->Cell(0,8,$ou,0,1);
}


}

$pdf = new PDF();
$pdf->AddPage();


$pdf->SetFont( 'Arial','B',$taille_coordos+2);
$pdf->Cell(80,6,$_SESSION['data']['ide']['nom'] . ' ' .  $_SESSION['data']['ide']['pre'],0,1);
$pdf->SetFont('Arial','',$taille_coordos);
$pdf->Cell(80,6,$_SESSION['data']['ide']['adr'],0,1);
$pdf->Cell(80,6,$_SESSION['data']['ide']['cod'] . ' ' . $_SESSION['data']['ide']['vil'],0,1);
$pdf->Cell(80,6,'06 74 22 43 22',0,1);
$pdf->Cell(80,6,'benjamin.billette@hotmail.fr',0,1);
$pdf->Cell(80,6,'N� le : ' . $_SESSION['data']['ide']['dat'] . ' (29 ans)',0,1);




//$pdf->Cell(0,$espace_coordos_titre,'',0,1); //espace_coordos_titre
$pdf->Ln($espaces_g+2);
//$pdf->SetFont('Arial','B',16);
//$pdf->Cell(0,8,'Candidature pour un poste de',0,1,'C');
$pdf->SetFont('Arial','B',$taille_titre);
$pdf->Cell(0,8,$_SESSION['data']['tit'],0,1);
$pdf->Cell(0,3,'',0,1,'C');
$pdf->SetFont('Arial','I',$taille_ss_titre);
$pdf->MultiCell(0,5,$_SESSION['data']['obj']);

$pdf->AjouterRu("EXPERIENCE PROFESSIONNELLE", $espaces_g, $taille_bandeaux);

foreach ($_SESSION['data']['exp'] as $xp) {
$pdf->AjouterItem('Du ' . $xp['datedebut']  . ' au ' . $xp['datefin'],
					$xp['prequoi'],
					$xp['nomou'] . ', ' . $xp['ville'] . ' (' . $xp['codedep'] . ')',
					$taille_texte
					);
}


$pdf->AjouterRu("FORMATION", $espaces_g, $taille_bandeaux);

foreach ($_SESSION['data']['for'] as $for) {
$pdf->AjouterItem('Du ' . $for['datedebut']  . ' au ' . $for['datefin'],
					$for['prequoi'],
					$for['nomou'] . ', ' . $for['ville'] . ' (' . $for['codedep'] . ')',
					$taille_texte
					);
}



$pdf->AjouterRu("INFORMATIONS COMPLEMENTAIRES", $espaces_g, $taille_bandeaux);
$pdf->SetFont('Arial','',$taille_texte);

foreach ($_SESSION['data']['inf'] as $inf) {
$pdf->Ln(4);
$pdf->Cell(0,8,$inf,0,1);
}

/*
$pdf->Cell(0,10,'Langues : Anglais (top), Allemand (super)',0,1);
$pdf->Cell(0,10,'Informatique : G�n�ration de PDFs (trop fort)',0,1);
$pdf->Cell(0,10,'Permis B et v�hicule',0,1);
$pdf->Cell(0,10,'Loisirs : musique (guitare), tennis, cin�ma, litt�rature',0,1);
*/

$pdf->Output();

?>
