<?php
function project_detail()
{
	include("php/settings.php");
	include("php/name.inc.php");
	if (empty($_GET["id"]))
	{
		?>
		<h1 class="error_not_found"><?php echo $error_not_found; ?></h1>
		<script lang="javascript">window.location = "../?page_id=63";</script>
		<?php
	} else {
		$detail = get_detail_project(($_GET["id"]));

		if(empty($detail[0]))
		{
			?>
			<h1 class="error_not_found"><?php echo $error_not_found; ?></h1>
			<script lang="javascript">window.location = "../?page_id=63";</script>
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

				<p class="item_value"><?php echo $detail[0]->Aanmaakdatum ?></p>

				<p class="item_name"><?php echo $detail_location; ?></p>

				<p class="item_value"><?php echo $detail[0]->Straat; ?></p>

				<p class="item_name"><?php echo $detail_category; ?></p>

				<p class="item_value"><?php echo $detail[0]->Categorie; ?></p>

				<p class="item_name"><?php echo $detail_website; ?></p>

				<p class="item_value"><?php echo $detail[0]->Website; ?></p>

				<p class="item_name"><?php echo $detail_description; ?></p>

				<p class="item_value"><?php echo $detail[0]->Omschrijving; ?></p>
			</section>
			<section class="buttons">
				<?php if ($project_owner) { ?>
				<a href="<?php echo add_query_arg(array('id'=>$detail[0]->Id),"../?page_id=87"); ?>"><button value="<?php echo $detail_edit; ?>"><?php echo $detail_edit; ?></button></a>
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
		<section class="members">
			<h2 class="section_name"><?php echo $detail_members; ?></h2>
			<ul>
				<?php 
				$array = $detail[2];
				$max = 0;
				if($detail_max_shown_members > count($array)) $max = count($array);
				else $max = $detail_max_shown_members;
				for($i =0;$i<$max;$i++)
					{?>
				<li><a href="<?php echo add_query_arg(array('id'=>$array[$i]->Id),"../?page_id=87"); ?>"><?php echo $array[$i]->Gebruikersnaam; ?></a></li>
				<?php
			}
			?>
			</ul>
		</section>
		<section id="events">
			<h2 class="section_name"><?php echo $detail_linked_events; ?></h2>
			<ul>
				<?php
				$array = $detail[3];
				$max = 0;
				if($detail_max_shown_events > count($array)) $max = count($array);
				else $max = $detail_max_shown_events;
				for($i =0;$i<$max;$i++)
					{?>
				<li class="offset">
					<a href="<?php echo add_query_arg(array('id'=>$array[$i]->Id),"../?page_id=87"); ?>">
						<p class="event_title"><?php echo $array[$i]->Titel; ?></p>

						<p class="event_date"><?php echo $array[$i]->Startdatum; ?></p>

						<p class="event_location"><?php echo $array[$i]->Straat; ?></p>

						<p class="event_description"><?php echo $array[$i]->Omschrijving; ?></p>
					</a>
				</li>
				<?php
			}
			?>	
		</ul>
		<?php
		if (count($detail[3]) > $detail_max_shown_events) {
			?>
			<p class="more_items"><a href=""><?php echo $detail_more_events; ?></a></p>
			<?php
		}
		?>
	</section>
	<section id="ads">
		<h2 class="section_name"><?php echo $detail_linked_ads; ?></h2>
		<ul>
			<?php
			$array = $detail[4];
			$max = 0;
			if($detail_max_shown_ads > count($array)) $max = count($array);
			else $max = $detail_max_shown_ads;
			for($i =0;$i<$max;$i++)
				{?>
			<li class="extra-height offset"><a href="<?php echo add_query_arg(array('id'=>$array[$i]->Id),"../?page_id=87"); ?>">
				<p class="ads_img"><img src="wp-content/themes/mokka/img/<?php echo GetAdFoto($array[$i]->Id); ?>"/></p>

				<p class="ads_name"><?php echo $array[$i]->Naam; ?></p>

				<p class="ads_date"><?php echo $array[$i]->Aanmaakdatum; ?></p>

				<p class="ads_linked_name"><?php echo $array[$i]->Omschrijving; ?></p>

			</a></li>
			<?php
		}
		?>
	</ul>
	<?php
	if (count($detail[4]) > $detail_max_shown_ads) {
		?>
		<p class="more_items"><a href=""><?php echo $detail_more_ads; ?></a></p>
		<?php
	}
	?>
</section>
<section id="articles">
	<h2 class="section_name"><?php echo $detail_linked_articles; ?></h2>
	<ul>
		<?php
		$array = $detail[5];
		$max = 0;
		if($detail_max_shown_articles > count($array)) $max = count($array);
		else $max = $detail_max_shown_articles;
		for($i =0;$i<$max;$i++)
			{?>
		<li class="offset"><a href="<?php echo add_query_arg(array('id'=>$array[$i]->Id),"../?page_id=87"); ?>">
			<p class="article_name"><?php echo $array[$i]->Naam; ?></p>

			<p class="article_date"><?php echo $array[$i]->Aanmaakdatum; ?></p>

			<p class="article_category"><?php echo $array[$i]->Categorie; ?></p>

			<p class="article_linked_value"><?php echo $array[$i]->Omschrijving; ?></p>
		</a>
	</li>
	<?php
}
?>
</ul>
<?php
if (count($detail[5]) > $detail_max_shown_articles) {
	?>
	<p class="more_items"><a href=""><?php echo $detail_more_article; ?></a></p>
	<?php
}
?>
</section>
<section class="comment_items">
	<ul>
		<?php
		$array = $detail[6];
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


function get_detail_project($id)
{
	include("php/settings.php");
	include("php/name.inc.php");
	$projectDetailArray = array();
	$projectFotosArray = array();
	$projectGebruikersArray = array();
	$projectEventsArray = array();
	$projectZoekertjesArray = array();
	$projectArtikelsArray = array();
	$projectReactiesArray = array();

	$bool = 1;
	
    //PROJECT
	$mydb = new wpdb('root','usbw','groenestraat','localhost:3307');
	$rows = $mydb->get_results($mydb->prepare("SELECT p.Id, p.Titel, p.Omschrijving, p.Aanmaakdatum, p.Looptijd, s.Gemeente, p.Straat, p.Website, u.Gebruikersnaam, c.Naam as Categorie FROM tblprojecten p JOIN tblgebruikers u ON p.AdminId=u.Id JOIN tblsteden s	ON p.PlaatsId = s.Id JOIN tblcategorieen c ON p.CategorieId = c.Id WHERE p.Id = %d AND p.Zichtbaar = %d",$id,$bool));
	$projectDetailArray = $rows[0];

	//REACTIES
	$mydb = new wpdb('root','usbw','groenestraat','localhost:3307');
	$rows = $mydb->get_results($mydb->prepare("SELECT tblReacties.* FROM tblProjectReacties RIGHT JOIN tblReacties ON tblProjectReacties.ReactieId = tblReacties.Id WHERE tblProjectReacties.ProjectId = %d AND tblReacties.Zichtbaar = %d",$id,$bool));
	$projectReactiesArray = $rows;

	//FOTOS
	$mydb = new wpdb('root','usbw','groenestraat','localhost:3307');
	$rows = $mydb->get_results($mydb->prepare("SELECT tblfotos.* FROM tblprojectfotos RIGHT JOIN tblFotos ON tblProjectfotos.FotoId = tblfotos.Id WHERE tblprojectfotos.ProjectId = %d",$id));
	$projectFotosArray = $rows;

	//LEDEN
	$mydb = new wpdb('root','usbw','groenestraat','localhost:3307');
	$rows = $mydb->get_results($mydb->prepare("SELECT tblgebruikers.* FROM tblprojectgebruikers RIGHT JOIN tblgebruikers ON tblprojectgebruikers.GebruikerId = tblgebruikers.Id WHERE tblprojectgebruikers.ProjectId = %d",$id));
	$projectGebruikersArray = $rows;

	//EVENTS
	$mydb = new wpdb('root','usbw','groenestraat','localhost:3307');
	$rows = $mydb->get_results($mydb->prepare("SELECT tblevents.* FROM tblprojectevents RIGHT JOIN tblevents ON tblprojectevents.EventId = tblevents.Id WHERE tblprojectevents.ProjectId = %d AND tblevents.Zichtbaar = %d",$id,$bool));
	$projectEventsArray = $rows;

	//ZOEKERTJES
	$mydb = new wpdb('root','usbw','groenestraat','localhost:3307');
	$rows = $mydb->get_results($mydb->prepare("SELECT tblzoekertjes.* FROM tblprojectzoekertjes RIGHT JOIN tblzoekertjes ON tblprojectzoekertjes.ZoekertjeId = tblzoekertjes.Id WHERE tblprojectzoekertjes.ProjectId = %d AND tblzoekertjes.Zichtbaar = %d",$id,$bool));
	$projectZoekertjesArray = $rows;

	//ARTIKELS
	$mydb = new wpdb('root','usbw','groenestraat','localhost:3307');
	$rows = $mydb->get_results($mydb->prepare("SELECT tblartikels.* FROM tblprojectartikels RIGHT JOIN tblartikels ON tblprojectartikels.ArtikelId = tblartikels.Id WHERE tblprojectartikels.ProjectId = %d AND tblartikels.Zichtbaar = %d",$id,$bool));
	$projectArtikelsArray = $rows;

	return array($projectDetailArray, $projectFotosArray, $projectGebruikersArray, $projectEventsArray, $projectZoekertjesArray, $projectArtikelsArray, $projectReactiesArray);
}

function GetGebruiker($id)
{
	$mydb = new wpdb('root','usbw','groenestraat','localhost:3307');
	$row = $mydb->get_var($mydb->prepare("SELECT Gebruikersnaam FROM tblgebruikers WHERE Id = %d",$id));
	return $row;
}

function GetAdFoto($id)
{
	$mydb = new wpdb('root','usbw','groenestraat','localhost:3307');
	$row = $mydb->get_var($mydb->prepare("SELECT Url FROM tblzoekertjefotos RIGHT JOIN tblfotos ON tblzoekertjefotos.FotoId = tblFotos.Id WHERE tblzoekertjefotos.ZoekertjeId = %d",$id));
	return $row;
}

function GetCommentFoto($id)
{
	$mydb = new wpdb('root','usbw','groenestraat','localhost:3307');
	$row = $mydb->get_var($mydb->prepare("SELECT Foto FROM tblgebruikers WHERE tblgebruikers.Id = %d",$id));
	return $row;
}

add_shortcode("project_detail","project_detail");
?>