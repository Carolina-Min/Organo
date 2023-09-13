<?php /* C:\laragon\www\organo_genero\wp-content\plugins\akeebabackupwp\app\Solo\ViewTemplates\Sysconfig\push.blade.php */ ?>
<?php
/**
 * @package   solo
 * @copyright Copyright (c)2014-2023 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license   GNU General Public License version 3, or later
 */

use Awf\Text\Text;
use Solo\Helper\Escape;
use Solo\Helper\FEFSelect;

defined('_AKEEBA') or die();

/** @var \Solo\View\Sysconfig\Html $this */

$config = $this->getContainer()->appConfig;

/**
 * Remember to update wpcli/Command/Sysconfig.php in the WordPress application whenever this file changes.
 */
?>
<div class="akeeba-form-group">
    <label for="desktop_notifications">
		<?php echo \Awf\Text\Text::_('COM_AKEEBA_CONFIG_DESKTOP_NOTIFICATIONS_LABEL'); ?>
    </label>
    <div class="akeeba-toggle">
		<?php echo FEFSelect::booleanList('options[desktop_notifications]', ['id' => 'desktop_notifications', 'forToggle' => 1, 'colorBoolean' => 1], $config->get('options.desktop_notifications', 0)); ?>

    </div>
    <p class="akeeba-help-text">
		<?php echo \Awf\Text\Text::_('COM_AKEEBA_CONFIG_DESKTOP_NOTIFICATIONS_DESC'); ?>
    </p>
</div>

<div class="akeeba-form-group">
    <label for="push_preference">
		<?php echo \Awf\Text\Text::_('COM_AKEEBA_CONFIG_PUSH_PREFERENCE_LABEL'); ?>
    </label>
    <div class="akeeba-toggle">
		<?php echo FEFSelect::booleanList('options[push_preference]', ['id' => 'push_preference', 'forToggle' => 1, 'colorBoolean' => 1], $config->get('options.push_preference', 0)); ?>

    </div>
    <p class="akeeba-help-text">
		<?php echo \Awf\Text\Text::_('COM_AKEEBA_CONFIG_PUSH_PREFERENCE_DESC'); ?>
    </p>
</div>

<div class="akeeba-form-group">
    <label for="push_apikey">
		<?php echo \Awf\Text\Text::_('COM_AKEEBA_CONFIG_PUSH_APIKEY_LABEL'); ?>
    </label>
    <input type="text" name="options[push_apikey]" id="push_apikey"
           placeholder="<?php echo \Awf\Text\Text::_('COM_AKEEBA_CONFIG_PUSH_APIKEY_LABEL'); ?>"
           value="<?php echo $config->get('options.push_apikey'); ?>">
    <p class="akeeba-help-text">
		<?php echo \Awf\Text\Text::_('COM_AKEEBA_CONFIG_PUSH_APIKEY_DESC'); ?>
    </p>
</div>
