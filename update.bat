@echo off

:: Tarix + saat götür (Windows formatından parse edirik)
for /f "tokens=1-4 delims=/ " %%a in ("%date%") do (
    set day=%%a
    set month=%%b
    set year=%%c
)

for /f "tokens=1-2 delims=: " %%a in ("%time%") do (
    set hour=%%a
    set minute=%%b
)

:: Saatda boşluq problemi olmasın deyə
set hour=%hour: =0%

:: Commit message
set msg=deyisiklik-%year%-%month%-%day%-%hour%-%minute%

echo Commit message: %msg%

git add .
git commit -m "%msg%"
git push origin main

pause