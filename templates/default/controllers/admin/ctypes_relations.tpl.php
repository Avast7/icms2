<h1><?php echo LANG_CONTENT_TYPE; ?>: <span><?php echo $ctype['title']; ?></span></h1>

<?php

    $this->setPageTitle(LANG_CP_CTYPE_RELATIONS, $ctype['title']);

    $this->addBreadcrumb(LANG_CP_SECTION_CTYPES, $this->href_to('ctypes'));

    $this->addBreadcrumb($ctype['title'], $this->href_to('ctypes', array('edit', $ctype['id'])));
    $this->addBreadcrumb(LANG_CP_CTYPE_RELATIONS);

    $this->addMenuItems('ctype', $this->controller->getCtypeMenu('relations', $ctype['id']));

    $this->addToolButton(array(
        'class' => 'add',
        'title' => LANG_CP_RELATION_ADD,
        'href'  => $this->href_to('ctypes', array('relations_add', $ctype['id']))
    ));
	$this->addToolButton(array(
		'class' => 'help',
		'title' => LANG_HELP,
		'target' => '_blank',
		'href'  => LANG_HELP_URL_CTYPES_RELATIONS
	));

?>

<div class="pills-menu">
    <?php $this->menu('ctype'); ?>
</div>

<?php $this->renderGrid($this->href_to('ctypes', array('relations', $ctype['id'])), $grid);
