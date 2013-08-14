<!-- Script for selecting genre (while booking artist) -->
	<div>
	    Select artists from the following genre:
	    <div class="genre_options_container">
		<form method="post" action="book_artist.php">
		    <input type="submit" name="genre_filter" value="genre 1" class="genre_options">
		    <input type="submit" name="genre_filter" value="genre 2" class="genre_options">
		</form>
		<div class="clear_fix"></div>
	    </div>
	    Or search for artists:
	    <div class="searchBox">
		<form method="post" action="book_artist.php">
		    <label for="search_term" style="opacity: 1">Enter search query</label>
		    <input type="text" name="search_term" class="search_term_text_box">
		    <input type="submit" value"Search" class="search_button">
		</form>
	    </div>
	</div>

