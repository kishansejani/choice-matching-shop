@echo off
echo ===========================================
echo PROJECT AUTO-UPLOAD TO GITHUB
echo ===========================================
cd /d "c:\xampp\htdocs\project\project"
echo Adding files...
git add .
echo Committing changes...
git commit -m "Complete Project with Database"
echo.
echo Pushing to GitHub (A login window might appear)...
git push -u origin main --force
echo.
echo ===========================================
echo DONE! You can now close this window.
echo ===========================================
pause
