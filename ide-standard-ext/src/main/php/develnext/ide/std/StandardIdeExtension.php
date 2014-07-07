<?php
namespace develnext\ide\std;

use develnext\filetype\creator\DirectoryCreator;
use develnext\filetype\creator\FileCreator;
use develnext\filetype\DirectoryFileType;
use develnext\filetype\ExternalRootDirectoryFileType;
use develnext\filetype\UnknownFileType;
use develnext\ide\IdeExtension;
use develnext\ide\IdeManager;
use develnext\ide\std\filetype\creator\PhpFileCreator;
use develnext\ide\std\filetype\GradleFileType;
use develnext\ide\std\filetype\PhpFileType;
use develnext\ide\std\filetype\SwingFormFileType;
use develnext\ide\std\filetype\TextFileType;
use develnext\ide\std\project\type\ConsoleProjectType;
use develnext\ide\std\project\type\GuiProjectType;

class StandardIdeExtension extends IdeExtension {

    protected function registerMainMenu(IdeManager $manager) {
        $manager->addMenuGroup('file', _('File'));
            $manager->addMenuItem('file', 'new-project', _('New Project'), 'images/icons/project16.png', 'control N');
            $manager->addMenuItem('file', 'open-project', _('Open Project'), 'images/icons/open16.png', 'control O');
            $manager->addMenuItem('file', 'close-project', _('Close Project'));
            $manager->addMenuSeparator('file');

            $manager->addMenuItem('file', 'save-all', _('Save All'), 'images/icons/save16.png', 'control S');
            $manager->addMenuItem('file', 'settings', _('Settings'), 'images/icons/settings16.png');
            $manager->addMenuSeparator('file');

            $manager->addMenuItem('file', 'exit', _('Exit'));

        // ------
        $manager->addMenuGroup('edit', _('Edit'));
            $manager->addMenuItem('edit', 'undo', _('Undo'), 'images/icons/undo16.png', 'control Z');
            $manager->addMenuItem('edit', 'redo', _('Redo'), 'images/icons/redo16.png', 'control shift Z');
            $manager->addMenuSeparator('edit');

            $manager->addMenuItem('edit', 'delete', _('Delete'), 'images/icons/cancel16.png', 'DELETE');

        // ------
        $manager->addMenuGroup('build', _('Build'));
            $manager->addMenuItem('build', 'run', _('Run'), 'images/icons/play16.png', 'F9');

        // ------
        $manager->addMenuGroup('tools', _('Tools'));
    }

    protected function registerHeadMenu(IdeManager $manager) {
        $manager->addHeadMenuItem('file:new-project', 'images/icons/project16.png');
        $manager->addHeadMenuItem('file:open-project', 'images/icons/open16.png');
        $manager->addHeadMenuItem('file:save-all', 'images/icons/save16.png');
        $manager->addHeadMenuSeparator();
        $manager->addHeadMenuItem('build:run', 'images/icons/play16.png');
        $manager->addHeadMenuItem('file:settings', 'images/icons/settings16.png');
    }

    protected function registerPopupTreeMenu(IdeManager $manager) {
        $manager->addFileTreePopupGroup('new', _('Create'), 'images/icons/plus16.png');
        $manager->addFileTreePopupItem(null, 'edit:copy-files', __('{Add file/directory} ...'), 'images/icons/plus16.png');
            $manager->addFileTreePopupSeparator();
        $manager->addFileTreePopupItem(null, 'edit:delete', _('Delete'), 'images/icons/cancel16.png', 'DELETE');
        $manager->addFileTreePopupItem(null, '', _('Hide'));
            $manager->addFileTreePopupSeparator();
        $manager->addFileTreePopupItem(null, '', __('{Find in Path} ...'), 'images/icons/find16.png', 'control shift F');
        $manager->addFileTreePopupItem(null, '', __('{Replace in Path} ...'), null, 'control shift R');

        $manager->registerFileTypeCreator(new FileCreator(), true);
        $manager->registerFileTypeCreator(new DirectoryCreator(), true);
        $manager->addFileTreePopupSeparator('new');
        $manager->registerFileTypeCreator(new PhpFileCreator(), true);
    }

    public function onRegister(IdeManager $manager) {
        $manager->addLocalizationPath('res://i18n/std');

        $this->registerMainMenu($manager);
        $this->registerHeadMenu($manager);
        $this->registerPopupTreeMenu($manager);

        $menuHandlers = new StandardIdeMenuHandlers();
        $manager->setMenuHandlers($menuHandlers->getHandlers());

        // file types
        $manager->registerFileType(new UnknownFileType());
        $manager->registerFileType(new DirectoryFileType());
        $manager->registerFileType(new ExternalRootDirectoryFileType());
        $manager->registerFileType(new TextFileType());
        $manager->registerFileType(new PhpFileType());
        $manager->registerFileType(new SwingFormFileType());
        $manager->registerFileType(new GradleFileType());

        // project types
        $manager->registerProjectType(new ConsoleProjectType());
        $manager->registerProjectType(new GuiProjectType());
    }
}
