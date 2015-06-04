<?php
function event_detail()
{
	include("php/settings.php");
	include("php/name.inc.php");
	if (empty($_GET["id"]))
	{
		?>
		<h1 class="error_not_found"><?php echo $error_not_found; ?></h1>
		<script lang="javascript">window.location = "../?page_id=74";</script>
		<?php
	}
	else 
	{
		$detail = get_detail_events(($_GET["id"]));
		$link = get_event_link($_GET["id"]);
		if(empty($detail[0]))
		{
			?>
			<h1 class="error_not_found"><?php echo $error_not_found; ?></h1>
			<script lang="javascript">window.location = "../?page_id=74";</script>
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
			<p class="item_name"><?php echo $event_start_date; ?></p>
			<p class="item_value"><?php echo $detail[0]->Startdatum; ?></p>
			<p class="item_name"><?php echo $event_end_date; ?></p>
			<p class="item_value"><?php echo $detail[0]->Einddatum; ?></p>
			<p class="item_name"><?php echo $event_start_time; ?></p>
			<p class="item_value"><?php echo $detail[0]->Starttijd; ?></p>
			<p class="item_name"><?php echo $detail_location; ?></p>
			<p class="item_value"><?php echo $detail[0]->Gemeente; ?></p>
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
					?> <p class="item_value"><a href="<?php echo add_query_arg(array('id'=>$link->Id),"../?page_id=87"); ?>"><?php echo $link->Titel; ?></a></p> <?php

				}
				?>
			<p class="item_name"><?php echo $detail_category; ?></p>
			<p class="item_value"><?php echo $detail[0]->Categorie; ?></p>
			<p class="item_name"><?php echo $detail_website; ?></p>
			<p class="item_value"><?php echo $detail[0]->Website; ?></p>
			<p class="item_name"><?php echo $detail_description; ?></p>
			<p class="item_value"><?php echo $detail[0]->Omschrijving; ?></p>
			</section>
			<section class="buttons">
			<?php if($project_owner) {?>
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
			<section class="comment_items">
			<ul>
				<?php
				$array = $detail[3];
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

function get_detail_events($id)
{
	include("php/settings.php");
	include("php/name.inc.php");
	$eventDetailArray = array();
	$eventFotosArray = array();
	$eventGebruikersArray = array();
	$eventReactiesArray = array();

	$bool = 1;
	
	//EVENT
	$mydb = new wpdb('root','usbw','groenestraat','localhost:3307');
	$rows = $mydb->get_results($mydb->prepare("SELECT e.ID, e.Titel, e.Omschrijving, e.Startdatum, e.Einddatum, e.Starttijd, s.Gemeente, e.Straat, e.Website, u.Gebruikersnaam, c.Naam as Categorie FROM tblevents e JOIN tblgebruikers u ON e.AdminId = u.Id JOIN tblsteden s ON e.PlaatsId = s.Id JOIN tblcategorieen c ON e.CategorieId = c.Id WHERE e.Id = %d AND e.Zichtbaar = %d",$id,$bool));
	$eventDetailArray = $rows[0];

	//FOTOS
	$mydb = new wpdb('root','usbw','groenestraat','localhost:3307');
	$rows = $mydb->get_results($mydb->prepare("SELECT tblFotos.* FROM tbleventfotos RIGHT JOIN tblFotos ON tbleventfotos.FotoId = tblfotos.Id WHERE tbleventfotos.EventId = %d",$id));
	$eventFotosArray = $rows;

	//LEDEN
	$mydb = new wpdb('root','usbw','groenestraat','localhost:3307');
	$rows = $mydb->get_results($mydb->prepare("SELECT tblgebruikers.* FROM tbleventgebruikers RIGHT JOIN tblgebruikers ON tbleventgebruikers.GebruikerId = tblgebruikers.Id WHERE tbleventgebruikers.EventId = %d",$id));
	$eventGebruikersArray = $rows;

	//REACTIES
	$mydb = new wpdb('root','usbw','groenestraat','localhost:3307');
	$rows = $mydb->get_results($mydb->prepare("SELECT tblReacties.* FROM tbleventreacties RIGHT JOIN tblReacties ON tbleventreacties.ReactieId = tblReacties.Id WHERE tbleventreacties.EventId = %d",$id));
	$eventReactiesArray = $rows;

	return array($eventDetailArray, $eventFotosArray, $eventGebruikersArray, $eventReactiesArray);
}

function get_event_link($id)
{
	$arrayLink = array();
	$mydb = new wpdb('root','usbw','groenestraat','localhost:3307');
	$rows = $mydb->get_results($mydb->prepare("SELECT tblProjecten.Titel, tblProjecten.Id FROM tblprojectevents RIGHT JOIN tblProjecten ON tblprojectevents.ProjectId = tblProjecten.Id WHERE tblprojectevents.EventId = %d",$id));
	return $rows[0];
}

add_shortcode("event_detail","event_detail");
?>