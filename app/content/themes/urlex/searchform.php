<form id="searchform" class="search-form" action="<?php echo site_url('/'); ?>" role="search">
  <input type="search" name="s" required="" oninvalid="this.setCustomValidity('Пожалуйста, заполните это поле.')" oninput="setCustomValidity('')" />
  <button type="submit"></button>
</form>
