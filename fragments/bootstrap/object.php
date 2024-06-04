<div class="mad-content">
	<div class="container">
		<div class="row hr-size-2 vr-size-2">
			<div class="mad-entities">

				<div class="mad-col">
					<article class="mad-entity">
						<div class="mad-entity-media">
							<img class="card-img-top" src="index.php?rex_media_type=rex_media_medium&rex_media_file=<?php echo $this->getVar('picture') ?>" alt="..." />
						</div>
						<div class="mad-entity-content">
							<div class="mad-entity-header">
								<h2 class="mad-entity-title">
									<?php echo $this->getVar('label') ?>
								</h2>
								<p><?php echo $this->getVar('description') ?></p>
                                <div class="object-variants">
                                    <h3>Varianten</h3>
                                    <?php foreach($this->getVar('variants') as $variant){
                                        echo '<div class="object-variant"><a href="?object_id='.$variant->id.'"><img class="card-img-top" src="index.php?rex_media_type=rex_media_medium&rex_media_file='.explode(',', $variant->pictures)[0].'" alt="'.$variant->label.'" /><p><strong>'.$variant->label.'</strong></p></a></div>';
                                    } ?>
                                </div>
							</div>
							<div class="mad-entity-footer">
<!--								<a class="btn mad-text-link" href="--><?php //echo rex_getUrl( rex_flexshop_cart::getArticleId() , rex_clang::getCurrentId(), ['func' => 'add', 'id' => $this->getVar('id')]) ?><!--" data-id="--><?php //echo $this->getVar('id') ?><!--">--><?php //echo $this->i18n('add_to_cart') ?><!--</a>-->
                                <p><span data-id="<?php echo $this->getVar('id')?>" class="flexshop-object-add btn btn-big"><i class="far fa-shopping-bag"></i> In den Warenkorb</span></p>
							</div>
						</div>
					</article>
				</div>

			</div>
		</div>
	</div>
</div>
