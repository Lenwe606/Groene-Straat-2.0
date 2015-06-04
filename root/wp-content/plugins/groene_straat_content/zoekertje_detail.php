<?php
function zoekertje_detail()
{
	include("php/settings.php");
	include("php/name.inc.php");
	if (empty($_GET["id"]))
	{
		?>
		<h1 class="error_not_found"><?php echo $error_not_found; ?></h1>
		<script lang="javascript">window.location = "../?page_id=83";</script>
		<?php
	} else {
		$detail = get_detail_zoekertje(($_GET["id"]));
		$link = get_zoekertje_link($_GET["id"]);

		if(empty($detail[0]))
		{
			?>
			<h1 class="error_not_found"><?php echo $error_not_found; ?></h1>
			<script lang="javascript">window.location = "../?page_id=83";</script>
			<?php

		}
		else
		{
			?>
			<h1 class="overview_title"><?php echo $detail[0]->Titel; ?></h1>
			<section class="info">
			<h2 class="section_name"><?php echo $detail_general; ?></h2>
			<p class="item_name"><?php echo $detail_owner; ?></p>
			<p class="item_value"><?php echo $detail[0]->Gebruikersnaam; ?></p>
			<p class="item_name"><?php echo $detail_creation_date; ?></p>
			<p class="item_value"><?php echo $detail[0]->Aanmaakdatum; ?></p>
			<p class="item_name"><?php echo $event_linked_project; ?></p>
			<?php
				if(empty($link)) 
				{
				?>
					<p class="item_value">Geen koppeling</p>
				<?php
				}
				else
				{ 
					?> <p class="item_value"><a href="<?php echo add_query_arg(array('id'=>$link->Id),"../?page_id=83"); ?>"><?php echo $link->Titel; ?></a></p> <?php

				}
				?>
			<p class="item_name"><?php echo $detail_description; ?></p>
			<p class="item_value"><?php echo $detail[0]->Omschrijving; ?></p>
			</section>
			<section class="buttons">
			<?php if($project_owner) {?>
				<a href="<?php echo add_query_arg(array('id'=>$detail[0]->Id),"../?page_id=null"); ?>"><button value="<?php echo $detail_edit; ?>"><?php echo $detail_edit; ?></button></a>
				<a><button value="<?php echo $detail_delete; ?>"><?php echo $detail_delete; ?></button></a>
			<?php } else { ?>
				<a><button value="<?php echo $detail_register; ?>"><?php echo $detail_register; ?></button></a>
			<?php } ?>
			</section>
			<section class="images">
			<h2 class="section_name"><?php echo $detail_images; ?></h2>
			<?php 
				$array = $detail[1]; 
				for($i = 0;$i<count($array);$i++)
					{?>
				<p><img src="wp-content/themes/mokka/img/<?php echo $array[$i]->Url ?>" /></p>
				<?php
				}
				?>
			</section>
			<section class="comment_items">
			<ul>
				<?php
				$array = $detail[2];
				for($i = 0;$i<count($array);$i++)
				{?>
				<li>
					<div class="comment_info">
						<p class="comment_date"><?php echo $array[$i]->Aanmaakdatum; ?></p>

						<p class="comment_img"><img src="wp-content/themes/mokka/img/<?php echo GetCommentFoto($array[$i]->AdminId); ?>"></p>

						<p class="comment_name"><?php echo GetGebruiker($array[$i]->AdminId); ?></p>
					</div>
					<p class="comment_reaction"><?php echo $array[$i]->Omschrijving; ?></p>
					<button>Verwijder</button>
				</li>
				<?php
				}
				?>
			</ul>
			<?php
			if (count($commentsArray) > $detail_max_shown_comments) {
				?>
				<p class="more_items"><a href=""><?php echo $detail_more_comment; ?></a></p>
				<?php
			}
			?>
			</section>
			<section class="comment_section">
				<form method="post">
					<p><?php echo $detail_place_comment; ?></p>
					<textarea></textarea>
					<input type="submit" value="<?php echo $detail_place_comment_button; ?>"/>
				</form>
			</section>
			<?php
		}
	}
}

function get_detail_zoekertje($id)
{
	include("php/settings.php");
	include("php/name.inc.php");
	$adDetailArray = array();
    $adPhotosArray = array();
    $adReactionsArray = array();
    $bool = 1;

    //ZOEKERTJE
    $mydb = new wpdb('root','usbw','groenestraat','localhost:3307');
    $rows = $mydb->get_results($mydb->prepare("SELECT tblZoekertjes.*, tblGebruikers.Gebruikersnaam as Gebruikersnaam, tblCategorieen.Naam as Categorie FROM tblZoekertjes inner join tblgebruikers ON tblZoekertjes.AdminId=tblGebruikers.Id inner join tblCategorieen ON tblZoekertjes.CategorieId = tblCategorieen.Id WHERE tblZoekertjes.Id = %d AND tblZoekertjes.Zichtbaar = %d",$id,$bool));
    $adDetailArray = $rows[0];

    //FOTOS
    $mydb = new wpdb('root','usbw','groenestraat','localhost:3307');
    $rows = $mydb->get_results($mydb->prepare("SELECT tblfotos.* FROM tblzoekertjefotos RIGHT JOIN tblfotos ON tblzoekertjefotos.FotoId = tblfotos.Id WHERE tblzoekertjefotos.ZoekertjeId = %d",$id));
    $adPhotosArray = $rows;

    //REACTIES
    $mydb = new wpdb('root','usbw','groenestraat','localhost:3307');
    $rows = $mydb->get_results($mydb->prepare("SELECT tblReacties.* FROM tblZoekertjeReacties RIGHT JOIN tblReacties ON tblZoekertjeReacties.ReactieId = tblReacties.Id WHERE tblZoekertjeReacties.ZoekertjeId = %d",$id));
    $adReactionsArray = $rows;

    return array($adDetailArray, $adPhotosArray, $adReactionsArray);
}

function get_zoekertje_link($id)
{
	$arrayLink = array();
	$mydb = new wpdb('root','usbw','groenestraat','localhost:3307');
	$rows = $mydb->get_results($mydb->prepare("SELECT tblProjecten.Titel, tblProjecten.Id FROM tblprojectzoekertjes RIGHT JOIN tblProjecten ON tblprojectzoekertjes.ProjectId = tblProjecten.Id WHERE tblprojectzoekertjes.ZoekertjeId = %d",$id));
	return $rows[0];
}
add_shortcode("zoekertje_detail","zoekertje_detail");
?>