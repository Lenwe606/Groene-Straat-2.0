<?php
function buttons_zoekertje_overview()
{
	include("php/settings.php");
	include("php/name.inc.php");
	?>
    <div id="top">
    	<section>
    		<a href="../newad"><button class="new_item" id="new_ad" name="new_ad"><?php echo $new_ad?></button></a>
    		<input placeholder="<?php echo $search_filter ?>" class="search_input"/>
    	</section>
    </div>
    <?php
}
add_shortcode("buttons_zoekertje_overview","buttons_zoekertje_overview");

function steden_zoekertje_overview()
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
    categorie_zoekertje_overview();
}

function categorie_zoekertje_overview()
{
	include("php/settings.php");
	include("php/name.inc.php");
	$mydb = new wpdb('root','usbw','groenestraat','localhost:3307');
	$rows = $mydb->get_results("SELECT Id, Naam FROM tblcategorieen WHERE Soort = 4");
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
add_shortcode("steden_zoekertje_overview","steden_zoekertje_overview");

function zoekertje_overview()
{
	include("php/settings.php");
	include("php/name.inc.php");
	$mydb = new wpdb('root','usbw','groenestraat','localhost:3307');
	$rows = $mydb->get_results("SELECT tblzoekertjes.*, tblgebruikers.gebruikersnaam as User, tblcategorieen.naam as Categorie, tblFotos.url as Url FROM tblzoekertjes inner join tblgebruikers on tblzoekertjes.AdminId = tblgebruikers.Id inner join tblcategorieen on tblzoekertjes.CategorieId = tblcategorieen.Id left join tblzoekertjefotos on tblzoekertjes.Id = tblzoekertjefotos.ZoekertjeId left join tblFotos on tblzoekertjefotos.ZoekertjeId = tblfotos.Id WHERE tblZoekertjes.Zichtbaar = 1");
	?>
	<section id="ads">
	<ul>
	<?php 
	$max = 0;
	if($max_shown_ads_per_page > count($rows))
	{
		$max = count($rows);
	}
	else
	{
		$max = $max_shown_ads_per_page;
	}

	for($i = 0;$i<$max;$i++)
	{
		?>
			<li class="offset">
            <a href="<?php echo add_query_arg(array('id'=>$rows[$i]->Id),"../?page_id=103"); ?>">
                <p class="ads_img"><img src="wp-content/themes/mokka/img/<?php echo $rows[$i]->Url; ?>"/></p>

                <p class="ads_name"><?php echo $rows[$i]->Titel; ?></p>

                <p class="ads_date"><?php echo $rows[$i]->Aanmaakdatum; ?></p>

                <p class="ads_linked_name"><?php echo $rows[$i]->Omschrijving; ?></p>
            </a>
        	</li>
		<?php
	}
	?>
	</ul>
	<?php
}
add_shortcode("zoekertje_overview","zoekertje_overview");
?>