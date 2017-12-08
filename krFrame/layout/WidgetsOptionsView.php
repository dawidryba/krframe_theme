<?php

namespace krFrame\layout;

class WidgetsOptionsView {

    public function view($obj,$instance)
    {
        ?>
        <div class="krFrameWidgets krClearFix">
            <div class="krFrameWidgetsHeader" id="krFrWgHeader">
                krFrame Setting
            </div>
            <div class="krFrameWidgetsOptions" id="krFrameWidgetsView">
                <div class="krFrameWidgetsInner">
                    <div class="krFrameWidgetsScroll krClearFix">
                        <i class="krFrameWidgetsClose dashicons dashicons-no-alt"></i>
                        <div class="krOpenTab">
                            <div class="krSubTitle">GENERAL SETTING</div>
                            <div class="krShowTab krClearFix">
                                <div class="krX50Table">
                                    <p class="krBlock">
                                        <label for="<?php echo $obj->get_field_id('widgetClass'); ?>">Widget class</label>
                                        <input class="krTagsInput" id="<?php echo $obj->get_field_id('widgetClass'); ?>" name="<?php echo $obj->get_field_name('widgetClass'); ?>" type="text" value="<?php echo $instance['widgetClass'];?>"/>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="krOpenTab">
                            <div class="krSubTitle">GRID / RESPONSIVE</div>
                            <div class="krShowTab krClearFix">
                                <p>
                                    <label for="<?php echo $obj->get_field_id('gridXl'); ?>">> 1200px</label>
                                    <select id="<?php echo $obj->get_field_id('gridXl'); ?>" name="<?php echo $obj->get_field_name('gridXl'); ?>">
                                        <?php for($numGrid = 12; $numGrid>=1; $numGrid--) { ?>
                                            <option <?php selected($instance['gridXl'], 'col-xl-'.$numGrid);?> value="col-xl-<?php echo $numGrid;?>">col-xl-<?php echo $numGrid;?></option>
                                        <?php } ?>
                                    </select>
                                    <input type="checkbox" id="<?php echo $obj->get_field_id('displayXl'); ?>" name="<?php echo $obj->get_field_name('displayXl'); ?>" <?php checked(isset($instance['displayXl']) ? $instance['displayXl'] : 0); ?> />
                                    <label for="<?php echo $obj->get_field_id('displayXl'); ?>">Hide on this device</label>
                                </p>
                                <p>
                                    <label for="<?php echo $obj->get_field_id('gridLg'); ?>">> 992px</label>
                                    <select id="<?php echo $obj->get_field_id('gridLg'); ?>" name="<?php echo $obj->get_field_name('gridLg'); ?>">
                                        <?php for($numGrid = 12; $numGrid>=1; $numGrid--) { ?>
                                            <option <?php selected($instance['gridLg'], 'col-lg-'.$numGrid);?> value="col-lg-<?php echo $numGrid;?>">col-lg-<?php echo $numGrid;?></option>
                                        <?php } ?>
                                    </select>
                                    <input type="checkbox" id="<?php echo $obj->get_field_id('displayLg'); ?>" name="<?php echo $obj->get_field_name('displayLg'); ?>" <?php checked(isset($instance['displayLg']) ? $instance['displayLg'] : 0); ?> />
                                    <label for="<?php echo $obj->get_field_id('displayLg'); ?>">Hide on this device</label>
                                </p>
                                <p>
                                    <label for="<?php echo $obj->get_field_id('gridMd'); ?>">> 767px</label>
                                    <select id="<?php echo $obj->get_field_id('gridMd'); ?>" name="<?php echo $obj->get_field_name('gridMd'); ?>">
                                        <?php for($numGrid = 12; $numGrid>=1; $numGrid--) { ?>
                                            <option <?php selected($instance['gridMd'], 'col-md-'.$numGrid);?> value="col-md-<?php echo $numGrid;?>">col-md-<?php echo $numGrid;?> </option>
                                        <?php } ?>
                                    </select>
                                    <input type="checkbox" id="<?php echo $obj->get_field_id('displayMd'); ?>" name="<?php echo $obj->get_field_name('displayMd'); ?>" <?php checked(isset($instance['displayMd']) ? $instance['displayMd'] : 0); ?> />
                                    <label for="<?php echo $obj->get_field_id('displayMd'); ?>">Hide on this device</label>
                                </p>
                                <p>
                                    <label for="<?php echo $obj->get_field_id('gridSm'); ?>"> > 544px</label>
                                    <select id="<?php echo $obj->get_field_id('gridSm'); ?>" name="<?php echo $obj->get_field_name('gridSm'); ?>">
                                        <?php for($numGrid = 12; $numGrid>=1; $numGrid--) { ?>
                                            <option <?php selected($instance['gridSm'], 'col-sm-'.$numGrid);?> value="col-sm-<?php echo $numGrid;?>">col-sm-<?php echo $numGrid;?></option>
                                        <?php } ?>
                                    </select>
                                    <input type="checkbox" id="<?php echo $obj->get_field_id('displaySm'); ?>" name="<?php echo $obj->get_field_name('displaySm'); ?>" <?php checked(isset($instance['displaySm']) ? $instance['displaySm'] : 0); ?> />
                                    <label for="<?php echo $obj->get_field_id('displaySm'); ?>">Hide on this device</label>
                                </p>
                                <p>
                                    <label for="<?php echo $obj->get_field_id('gridXs'); ?>">< 544px</label>
                                    <select id="<?php echo $obj->get_field_id('gridXs'); ?>" name="<?php echo $obj->get_field_name('gridXs'); ?>">
                                        <?php for($numGrid = 12; $numGrid>=1; $numGrid--) { ?>
                                            <option <?php selected($instance['gridXs'], 'col-'.$numGrid);?> value="col-<?php echo $numGrid;?>">col-<?php echo $numGrid;?> </option>
                                        <?php } ?>
                                    </select>
                                    <input type="checkbox" id="<?php echo $obj->get_field_id('displayXs'); ?>" name="<?php echo $obj->get_field_name('displayXs'); ?>" <?php checked(isset($instance['displayXs']) ? $instance['displayXs'] : 0); ?> />
                                    <label for="<?php echo $obj->get_field_id('displayXs'); ?>">Hide on this device</label>
                                </p>
                                <hr class="krClearFix"/>
                            </div>
                        </div>
                        <div class="krOpenTab">
                            <div class="krSubTitle">TITLE SETTING</div>
                            <div class="krShowTab krClearFix">
                                <div class="krX50Table">
                                    <p class="krBlock">
                                        <label for="<?php echo $obj->get_field_id('titAwesome'); ?>">CSS icon class (e.g fa-tablet)</label>
                                        <input class="krTagsInput" id="<?php echo $obj->get_field_id('titAwesome'); ?>" name="<?php echo $obj->get_field_name('titAwesome'); ?>" type="text" value="<?php echo $instance['titAwesome'];?>"/>
                                    </p>
                                </div>
                                <div class="krX50Table">
                                    <p class="krBlock">
                                        <label for="<?php echo $obj->get_field_id('titClass'); ?>">CSS title class</label>
                                        <input class="krTagsInput" id="<?php echo $obj->get_field_id('titClass'); ?>" name="<?php echo $obj->get_field_name('titClass'); ?>" type="text" value="<?php echo $instance['titClass'];?>"/>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="krFrameWidgetsButtonClose">Save Changes</div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}
