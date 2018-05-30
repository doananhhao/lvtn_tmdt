<?php
function displayProduct($productName,$is_new,$is_sale,$is_hot,$productImageURL,$id = 1,$actionType = 'homepage-cart', $oldPrice = 800.00,$price = 650.99, $score = 3){
?>

	<div class="product">		
		<div class="product-image">
			<div class="image">
                <a href="{{ route('chitietsanpham', ['tensp'=>$id]) }}"><img  src="{{ asset('shop/images/blank.gif') }}" data-echo="<?php echo $productImageURL;?>" alt=""></a>
			</div><!-- /.image -->			

			<?php if($is_new):?><div class="tag new"><span>new</span></div><?php endif;?>
            <?php if($is_sale):?><div class="tag sale"><span>sale</span></div><?php endif;?>
            <?php if($is_hot):?><div class="tag hot"><span>hot</span></div><?php endif;?>
		   
		</div><!-- /.product-image -->
			
		
		<div class="product-info text-left">
			<h3 class="name"><a href="{{ route('chitietsanpham', ['tensp'=>$id]) }}"><?php echo $productName;?></a></h3>
			{{-- <div class="rating rateit-small"></div> --}}
			<div class="rateit" data-rateit-value="{{ $score }}" data-rateit-ispreset="true" data-rateit-readonly="true"></div>
			{{-- <div class="description"></div> --}}

			<div class="product-price">	
				<span class="price"><?php echo number_format($price, 0, ',', '.');?></span>
					<?php if($oldPrice != 0):?>
				<span class="price-before-discount"><?php echo number_format($oldPrice, 0, ',', '.');?></span>
					<?php endif;?>
				
			</div><!-- /.product-price -->
			
		</div><!-- /.product-info -->
		<?php if($actionType == 'all'): ?>
			<div class="cart clearfix animate-effect">
				<div class="action">
					<ul class="list-unstyled">
						<li class="add-cart-button btn-group">
							<button class="btn btn-primary icon" data-toggle="dropdown" type="button">
								<i class="fa fa-shopping-cart"></i>													
							</button>
							<button class="btn btn-primary" type="button">Add to cart</button>
													
						</li>
	                   
		                <li class="lnk wishlist">
							<a class="add-to-cart" href="#" title="Wishlist">
								 <i class="icon fa fa-heart"></i>
							</a>
						</li>

						<li class="lnk">
							<a class="add-to-cart" href="#" title="Compare">
							    <i class="fa fa-retweet"></i>
							</a>
						</li>
					</ul>
				</div><!-- /.action -->
			</div><!-- /.cart -->
		<?php elseif($actionType == 'cart'): ?>
			<div class="action"><a href="#" class="lnk btn btn-primary">Add to Cart</a></div>
		<?php elseif($actionType == 'homepage-cart'): ?>
			<div class="cart clearfix animate-effect">
				<div class="action">
								
					<button class="btn btn-primary" type="button" onclick="add_to_cart(this, {{ $id }})">Add to cart</button>
					<button class="left btn btn-primary" type="button"><i class="icon fa fa-heart"></i></button>
					{{-- <button class="left btn btn-primary" type="button"><i class="fa fa-retweet"></i></button>						 --}}

		                
					
				</div><!-- /.action -->
			</div><!-- /.cart -->
		<?php endif; ?>
	</div><!-- /.product -->
      
<?php	
}

?>