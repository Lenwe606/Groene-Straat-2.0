<?php 
function buttons_project_overview()
{
	include("php/settings.php");
	include("php/name.inc.php");
	?>
    <div id="top">
    	<section>
    		<a href="../newproject"><button class="new_item" id="new_project" name="new_project"><?php echo $new_project ?></button></a>
    		<input placeholder="<?php echo $search_filter ?>" class="search_input"/>
    	</section>
    </div>
    <?php
}
add_shortcode("buttons_project_overview","buttons_project_overview");

function steden_project_overview()
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
    categorie_project_overview();
}
add_shortcode("steden_project_overview","steden_project_overview");

function categorie_project_overview()
{
	include("php/settings.php");
	include("php/name.inc.php");
	$mydb = new wpdb('root','usbw','groenestraat','localhost:3307');
	$rows = $mydb->get_results("SELECT Id, Naam FROM tblcategorieen WHERE Soort = 1");
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


function projecten_overview()
{
	include("php/settings.php");
	include("php/name.inc.php");
	$mydb = new wpdb('root','usbw','groenestraat','localhost:3307');
	$rows = $mydb->get_results("SELECT Id, Titel, Aanmaakdatum, Straat, Omschrijving FROM tblprojecten WHERE Zichtbaar = 1");
	?>
	<section id="projects">
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

	for($i = 0;$i<$max;$i++)
	{
		?>
			<li>
            <a href="<?php echo add_query_arg(array('id'=>$rows[$i]->Id),"../?page_id=87"); ?>">
                <p class="project_title"><?php echo $rows[$i]->Titel; ?></p>

                <p class="project_date"><?php echo $rows[$i]->Aanmaakdatum; ?></p>

                <p class="project_location"><?php echo $rows[$i]->Straat; ?></p>

                <p class="project_description"><?php echo $rows[$i]->Omschrijving; ?></p>
            </a>
        	</li>
		<?php
	}
	?>
	</ul>
	<?php
}
add_shortcode("projecten_overview","projecten_overview");

?>