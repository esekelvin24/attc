
<li class="<?php if( Route::current()->getName()=='dashboard') echo "menu_colour" ?>">
    <a href="<?php echo route('dashboard') ?>">
        <div class="icon-w">
            <div class="icon-home"></div>
        </div>
        <span>Portal Dashboard</span>
    </a>
</li>
<li class="">
    <a href="<?php echo url('/') ?>">
                            <div class="icon-w">
                                <div class="icon-arrow-left-circle"></div>
                            </div>
                            <span>Home Page</span>
                        </a>
        </li>

<li class="">
    <a class="profile" href="#">
        <div class="icon-w">
            <div class="fa fa-user"></div>
        </div>
        <span>My Profile</span>
    </a>
</li>

<?php
for($a=0;$a<count($main_tab_id);$a++) {
    if($main_tab_permission_slug[$a] != "" && $user->can( $main_tab_permission_slug[$a])) {
    ?>
    
    <li class="has-sub-menu <?php
    if(isset($URL_FIRST_LEVEL_ID))
    {
        if($main_tab_id[$a]==$URL_FIRST_LEVEL_ID)
            echo "menu_colour";
    }
    ?>">
        <a href="#">
            <div class="icon-w">
                <div class="<?php echo $main_tab_icons[$a] ?>"></div>
            </div>
            <span><?php echo ucwords(($main_tab_name[$a])) ?></span></a>
        <div class="sub-menu-w">
            <div class="sub-menu-header">
                <?php echo ucwords(($main_tab_name[$a])) ?>
            </div>
            <div class="sub-menu-icon">
                <i class="<?php echo $main_tab_icons[$a] ?>"></i>
            </div>
            <div class="sub-menu-i">
                <ul class="sub-menu">
                    <?php
                   
                    for($b=0;$b<count($sub_tab_id);$b++) {
                      
                      if($sub_tab_permission_slug[$b] !="" && $user->can($sub_tab_permission_slug[$b])) {
                        if ($main_sub_tab_id[$b] == $main_tab_id[$a]) {
                            ?>
                            <li>
                                <a href="<?php
                                if( $sub_tab_named_route[$b]!="" or is_null($sub_tab_named_route[$b]) )
                                    echo route($sub_tab_named_route[$b]);
                                else
                                    echo "#";
                                ?>"><?php echo $sub_tab_name[$b] ?></a>
                            </li>
                            <?php
                        }
                     }
                    }
                    ?>
                </ul>
            </div>
        </div>
    </li>


    
    <?php
    }
}
?>

<li>
    <a href="#" onclick="document.getElementById('logout-form').submit();">
        <div class="icon-w">
            <div class="os-icon os-icon-log-out"></div>
        </div>
        <span>Log Out</span></a>
</li>

