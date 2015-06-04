<?php
function buttons_event_overview()
{
	include("php/settings.php");
	include("php/name.inc.php");
	?>
    <div id="top">
    	<section>
    		<a href="../?page_id=null"><button class="new_item" id="new_event" name="new_event"><?php echo $new_event ?></button></a>
    		<input placeholder="<?php echo $search_filter ?>" class="search_input"/>
    	</section>
    </div>
    <?php
}

function steden_event_overview()
{
	include("php/settings.php");
	include("php/name.inc.php");
	$mydb = new wpdb('root','usbw','groenestraat','localhost:3307');
	$rows = $mydb->get_results("SELECT Id, Gemeente FROM tblsteden GROUP BY Gemeente ASC");
	?>
	<div id="bottom">
	<section id="filter">
	<p class="filter_info"><?php echo $city_filter ?></p>
                <select id="cboSteden">
                <?php
                for($i=0;$i<count($rows);$i++)
				{
			    ?>
                <option value="<?php echo $rows[$i]->Id; ?>"><?php echo $rows[$i]->Gemeente; ?></option>
                <?php
            	}
            	?>
                </select>
    <?php
    categorie_event_overview();
}
add_shortcode("steden_event_overview","steden_event_overview");

function categorie_event_overview()
{
	include("php/settings.php");
	include("php/name.inc.php");
	$mydb = new wpdb('root','usbw','groenestraat','localhost:3307');
	$rows = $mydb->get_results("SELECT Id, Naam FROM tblcategorieen WHERE Soort = 2");
	?>
	<p class="filter_info"><?php echo $category_filter ?></p>
                <ul style="list-style-type: none;">
                <?php
				for($i = 0; $i < count($rows); $i++) {
        		?>
        		<li><a href=""><?php echo $rows[$i]->Naam; ?></a></li>
    			<?php
    			}
    			?>
                </ul>
                </section>
                <?php
}

function events_overview()
{
	include("php/settings.php");
	include("php/name.inc.php");
	$mydb = new wpdb('root','usbw','groenestraat','localhost:3307');
	$rows = $mydb->get_results("SELECT Id, Titel, Startdatum, Straat, Omschrijving FROM tblevents WHERE Zichtbaar = 1");
	?>
	<section id="events">
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
	<?php
}
add_shortcode("events_overview","events_overview");

add_shortcode("buttons_event_overview","buttons_event_overview");
?>