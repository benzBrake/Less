<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

function themeConfig($form)
{
    $logoUrl = new Typecho_Widget_Helper_Form_Element_Text('logoUrl', NULL, NULL, _t('站点LOGO地址'), _t('在这里填入一个图片URL地址, 以在网站标题前加上一个LOGO'));
    $form->addInput($logoUrl);
}


/*
function themeFields($layout) {
    $logoUrl = new Typecho_Widget_Helper_Form_Element_Text('logoUrl', NULL, NULL, _t('站点LOGO地址'), _t('在这里填入一个图片URL地址, 以在网站标题前加上一个LOGO'));
    $layout->addItem($logoUrl);
}
*/
function themeInit($archive)
{
    if ($archive->is('single') || $archive->is('page')) {
        viewsCounter($archive);
    }
}
/*
 * 转换时间显示方式为X天前
 * @param Typecho_Date $date
 * @return String
 */
function getDayAgo($date)
{
    $d = new Typecho_Date(Typecho_Date::gmtTime());
    $now = $d->format('Y-m-d H:i:s');
    $post = $date->format('Y-m-d H:i:s');
    $t = strtotime($now) - strtotime($post);
    if ($t < 60) return $t . '秒前';
    if ($t < 3600) return floor($t / 60) .  '分钟前';
    if ($t < 86400) return floor($t / 3670) . '小时前';
    if ($t < 604800) return floor($t / 86400) . '天前';
    if ($t < 2419200) return floor($t / 604800) .  '周前';
    if ($t < 31536000) return floor($t / 2592000) . '月前';
    return floor($t / 31536000) . '年前';
}

function getPostViews($widget, $format0 = "0", $format1 = "1", $formats = "%d", $return = false, $field = 'views')
{
    $fields = unserialize($widget->fields);
    if (array_key_exists($field, $fields)) {
        $fieldValue = (!empty($fields[$field])) ? intval($fields[$field]) : 0;
    } else {
        $fieldValue = 0;
    }
    if ($fieldValue == 0) {
        $fieldValue = sprintf($format0, $fieldValue);
    } else if ($fieldValue == 1) {
        $fieldValue = sprintf($format1, $fieldValue);
    } else {
        $fieldValue = sprintf($formats, $fieldValue);
    }
    if ($return) {
        return $fieldValue;
    } else {
        echo $fieldValue;
    }
}

/**
 * 增加浏览次数
 * 使用方法: 在<code>themeInit</code>函数中添加代码
 * <pre>if($archive->is('single') || $archive->is('page')){ viewsCounter($archive);}</pre>
 *
 * @param Widget_Archive $widget
 * @return boolean
 */
function viewsCounter($widget, $field = 'views')
{
    if (!$widget instanceof Widget_Archive) {
        return false;
    }

    $fieldValue = getPostViews($widget, "%d", "%d", "%d", true, $field);
    $fieldRecords = Typecho_Cookie::get('__typecho_' . $field);
    if (empty($fieldRecords)) {
        $fieldRecords = array();
    } else {
        $fieldRecords = explode(',', $fieldRecords);
    }

    if (!in_array($widget->cid, $fieldRecords)) {
        $fieldValue = $fieldValue + 1;
        $widget->setField($field, 'str', strval($fieldValue), $widget->cid);
        $fieldRecords[] = $widget->cid;
        $fieldRecords = implode(',', $fieldRecords);
        Typecho_Cookie::set('__typecho_' . $field, $fieldRecords);
        return true;
    }
    return false;
}
