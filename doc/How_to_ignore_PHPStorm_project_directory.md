# Make PHPStorm ignore .idea folder

1. First, make git ignore the .idea folder via Settings (CTRL+ALT+S): In the Project Settings > Version Control > Ignored Files dialog,
there’s a green “plus” sign on the right, click this and simply add the .idea folder

2. Open the “local” terminal in PHPStorm (Ctrl+Shift+X) and run: git rm --cached .idea/*
