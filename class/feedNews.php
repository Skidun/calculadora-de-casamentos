<?php 
// URL location of your feed
$feedUrl = "http://gnt.globo.com/noivas/dicas/index.rss_xml.xml";
$feedContent = "";
$count	= 0;
 
// Fetch feed from URL
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $feedUrl);
curl_setopt($curl, CURLOPT_TIMEOUT, 3);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HEADER, false);
 
// FeedBurner requires a proper USER-AGENT...
curl_setopt($curl, CURL_HTTP_VERSION_1_1, true);
curl_setopt($curl, CURLOPT_ENCODING, "gzip, deflate");
curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.0.3) Gecko/2008092417 Firefox/3.0.3");
 
$feedContent = curl_exec($curl);
curl_close($curl);
 
// Did we get feed content?
if($feedContent && !empty($feedContent)):
	$feedXml = @simplexml_load_string($feedContent);
	if($feedXml):
?>
<?php foreach($feedXml->channel->item as $item):
$count++;
?>

					<div class="post">
                    	<a href="<?php echo $item->link; ?>" target="_blank" id="foto"><img src="<?php echo $item->thumb;?>" /></a>
                        <div class="texto">
                            <div class="titulo"><a href="<?php echo $item->link; ?>" target="_blank"><?php echo $item->title; ?></a></div>
                            <div class="meta-data">Dica | <?php echo date('d/m/Y', strtotime($item->pubDate))." - ".date('H:i:s', strtotime($item->pubDate));?></div>
                            <div class="conteudo"><a href="<?php echo $item->link; ?>" target="_blank" title="<?php echo $item->title; ?>"><?php echo $item->description; ?></a></div>
                        </div>
                        <div style="clear:both"></div>
                    </div>
                    <div style="clear:both"></div>
<?php
if($count == 4){break;}
?>
<?php endforeach; ?>
<?php endif;?>
<?php endif;?>