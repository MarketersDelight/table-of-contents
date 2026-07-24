<script>

var toc = document.getElementById( '<?php echo $this->id; ?>' );

if ( toc === null ) return;

var active = -1,
	tocItems = toc.querySelectorAll( '.toc-item' ),
	headings = content.querySelectorAll( 'h2, h3, h4, h5, h6' );

for ( var i = 0; i < headings.length; i++ )
	if ( headings[i].offsetTop + contentBoxOffsetTop <= pos + 20 )
		active = i;

for ( var c = 0; c < tocItems.length; c++ ) {
	tocItems[c].classList.remove( 'active' );
	tocItems[c].classList.remove( 'child-active' );
}

if ( active >= 0 && tocItems[active] ) {
	tocItems[active].classList.add( 'active' );

	if ( tocItems[active].parentNode.classList.contains( 'toc-sublist' ) )
		tocItems[active].parentNode.parentNode.classList.add( 'child-active' );
}
