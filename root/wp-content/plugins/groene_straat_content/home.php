<?php
function get_news_limited()
{
	include("php/settings.php");
	include("php/name.inc.php");
	/*
	$mydb = new wpdb('root','usbw','groenestraat','localhost:3307');
	$rows = $mydb->query($mydb->prepare("SELECT "))*/
	$newsArray = array();
    $newsArray[] = array("Datum", "wp-content/themes/mokka/img/temp.jpg", "Admin", "De reactie tekst");
    $newsArray[] = array("Datum", "wp-content/themes/mokka/img/temp.jpg", "Admin", "De reactie tekst");
    $newsArray[] = array("Datum", "wp-content/themes/mokka/img/temp.jpg", "Admin", "De reactie tekst");
    $newsArray[] = array("Datum", "wp-content/themes/mokka/img/temp.jpg", "Admin", "De reactie tekst");
	?>
		<section id="news" class="section_header">
		<h1 class="section_name"><?php echo $news; ?></h1>

		<ul>
		<?php
		$max = 0;
		if($max_shown_news > count($newsArray))
		{
			$max = count($newsArray);
		}
		else
		{
			$max = $max_shown_news;
		}

		for($i = 0;$i<$max;$i++)
		{
			?>
			<li>
            <section class="news_section_info">
                <p class="news_date"><?php echo $newsArray[$i][0]; ?></p>

                <p class="news_img"><img src="<?php echo $newsarray[$i][1]; ?>"></p>

                <p class="news_name"><?php echo $newsArray[$i][2]; ?></p>
            </section>
            <section class="news_section_reaction">
                <p class="news_reaction"><?php echo $newsArray[$i][3]; ?></p>
            </section>
        	</li>
			<?php
		} ?>
		</ul>
		</section>
	<?php
	}
add_shortcode("news_limited","get_news_limited");

function get_events_limited()
{
		include("php/settings.php");
		include("php/name.inc.php");	
		
		$mydb = new wpdb('root','usbw','groenestraat','localhost:3307');
		$rows = $mydb->get_results("SELECT Id, Titel, Startdatum, Straat, Omschrijving FROM tblevents WHERE Zichtbaar = 1 ORDER BY Id DESC");
		?>
		<section id="events" class="section_header">
            <h1 class="section_name"><?php echo $future_events; ?></h1>
            <ul>
            <?php 
            $max = 0;
            if($max_shown_events > count($rows))
            {
            	$max = count($rows);
            }
            else
            {
            	$max = $max_shown_events;
            }

            for($i = 0;$i<$max;$i++)
            {
            	?>
					<li>
           				<a href="<?php echo add_query_arg(array('id'=>$rows[$i]->Id),"../?page_id=100"); ?>">
                		<p class="event_title"><?php echo $rows[$i]->Titel; ?></p>

                		<p class="event_date"><?php echo $rows[$i]->Startdatum; ?></p>

                		<p class="event_location"><?php echo $rows[$i]->Straat; ?></p>

                		<p class="event_description"><?php echo $rows[$i]->Omschrijving; ?></p>
            			</a>
        			</li>
            	<?php
            }
            ?>
            </ul>
            </section>
            <?php

}
add_shortcode("events_limited","get_events_limited");

function get_projects_limited()
{
		include("php/settings.php");
		include("php/name.inc.php");	
		
		$mydb = new wpdb('root','usbw','groenestraat','localhost:3307');
		$rows = $mydb->get_results("SELECT project.Id, project.Titel, project.Aanmaakdatum, project.Straat, project.Omschrijving FROM tblprojecten project join tblprojectgebruikers user on project.Id = user.ProjectId WHERE project.Zichtbaar = 1 GROUP BY project.Titel ORDER BY count(user.ProjectId) desc");
		?>
		
        		<section id="projects" class="section_header">
				<h1 class="section_name"><?php echo $popular_projects ?></h1>
				
				<ul>
				<?php
				$max = 0;
				if($max_shown_projects > count($rows))
				{
					$max = count($rows);
				}
				else 
				{
					$max = $max_shown_projects;
				}

				for($i = 0; $i < $max; $i++){
				?>
					<li><a href="<?php echo add_query_arg(array('id'=>$rows[$i]->Id),"../?page_id=87"); ?>">
                <p class="project_title"><?php echo $rows[$i]->Titel; ?></p>

                <p class="project_date"><?php echo $rows[$i]->Aanmaakdatum; ?></p>

                <p class="project_location"><?php echo $rows[$i]->Straat; ?></p>

                <p class="project_description"><?php echo $rows[$i]->Omschrijving; ?></p>
            </a></li>
				<?php
				}
				?>
				</ul>
				</section>
			
		<?php
	
}

add_shortcode("projects_limited","get_projects_limited");

?>