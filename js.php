<script>

tableOfContents: function() {
	var headings = [], pos = 0, ticking = false,
		contentBox = document.getElementById( 'content_box' ),
		contentBoxOffsetTop = contentBox.offsetTop,
		toc = document.getElementById( 'table_of_contents' ),
		tocHeight = toc.clientHeight,
		tocOffsetTop = toc.offsetTop + contentBoxOffsetTop,
		tocTitle = document.getElementById( 'toc_title' ),
		content = document.getElementById( 'the_content' ),
		postContent = content.getElementsByTagName( '*' ),
		tocItems = document.getElementsByClassName( 'toc-item' );

	MD.onScroll();

	for ( var i = 0, n = postContent.length; i < n; i++ )
		if ( /^h\d{1}$/gi.test( postContent[i].nodeName ) )
			headings.push( postContent[i] );

	for ( var i = 0, n = tocItems.length; i < n; i++ ) {
		var tocItem = tocItems[i],
			id = tocItem.getAttribute( 'data-toc-id' );

		headings[i].setAttribute( 'id', id );

		tocItem.onclick = function( e ) {
			var id = this.getAttribute( 'data-toc-id' ),
				order = this.getAttribute( 'data-toc-order' );
			for ( var c = 0; c < tocItems.length; c++ )
				MD.removeClass( tocItems[c], 'active' );
			MD.addClass( this, 'active' );
			MD.removeClass( toc, 'open' );
			window.scrollTo({
				'top' : ( headings[order].offsetTop /* - headings[order].clientHeight */ ) + contentBoxOffsetTop,
				'behavior' : 'smooth'
			});
			window.history.pushState( {}, '', window.location.pathname + '#' + id );
		}
	}

	tocTitle.onclick = function( e ) {
		MD.toggleClass( toc, 'open' );
	}
},