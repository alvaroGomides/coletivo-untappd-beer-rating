<?php
/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://coletivoroda.com.br
 * @since      1.0.0
 *
 * @package    Coletivo_Untappd_Beer_Rating
 * @subpackage Coletivo_Untappd_Beer_Rating/public/partials
 */

	$beer_rate = $beer_info->item->rating; //
	
	$rounded_rate = intval($beer_rate*100)/100;
	$beer_scaled = intval($beer_rate * 10);
?>
<div class="rating rating-holder ">
	<a href="<?php echo 'https://untappd.com/b/'. $beer_info->item->untappd_beer_slug . '/'. $beer_info->item->untappd_id; ?>" title="Check on Untappd!" target="_blank" class="untappd-link">
		<span class="small">UNTAPPD RATING</span>
	<div class="caps" data-rating="<?php echo $rounded_rate; ?>">
		<?php
			for($i=1;$i<=5;$i++){
				$calculated_rate = $beer_scaled - ($i*10);
				if($calculated_rate > 0 ){
					echo '<div class="cap cap-100"></div>';
				}else{
					if((10 + $calculated_rate) <= 0){
						echo '<div class="cap cap"></div>';
					}else{
						echo '<div class="cap cap-'.(10 + $calculated_rate).'0"></div>';
					}
				}
			}
		?>
	</div>
	<span class="num">(<?php echo $rounded_rate; ?>)</span> </a>
</div>
