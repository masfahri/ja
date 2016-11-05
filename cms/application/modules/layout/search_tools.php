<div class="header-table">
    <h4 class="text-info">Master Data</h4>
    <div class="search-table">
        <form action="<?= base_url($this->app_name).'/data' ?>" method="post">
            <?php
            if( isset($_POST['key']) )$val = $_POST['key'];
            else $val  = '';
            ?>
            <input type="text" name="key" value="<?= $val ?>"/> 
            <input type="submit" value="Search"/>
        </form>
    </div>
</div>
<div class="clear"></div>