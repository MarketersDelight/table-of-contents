<script>

tableOfContents: function() {
	var headings = [],
		toc = document.getElementById( 'table_of_contents' ),
		content = document.getElementById( 'the_content' ),
		tocItems = toc.getElementsByClassName( 'toc-item' ),
		postContent = content.getElementsByTagName( '*' );

	for ( var i = 0, n = postContent.length; i < n; i++ )
		if ( /^h[2-6]$/i.test( postContent[i].nodeName ) )
			headings.push( postContent[i] );

	for ( var i = 0, n = tocItems.length; i < n; i++ ) {
		headings[i].setAttribute( 'id', tocItems[i].getAttribute( 'data-toc-id' ) );

		var label = tocItems[i].querySelector( '.toc-item-label' );

		if ( label ) label.onclick = (function( item, order ) {
			return function( e ) {
				e.preventDefault();
				var contentBox = document.getElementById( 'main' );
				window.scrollTo({
					top: headings[order].offsetTop + contentBox.offsetTop,
					behavior: 'smooth'
				});
				window.history.pushState( {}, '', '#' + item.getAttribute( 'data-toc-id' ) );
			};
		})( tocItems[i], i );
	}

	toc.querySelector( '.widget-title' ).onclick = function() { MD.toggleClass( toc, 'open' ); };
},