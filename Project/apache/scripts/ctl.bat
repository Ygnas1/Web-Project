@echo off

if not ""%1"" == ""START"" goto stop

cmd.exe /C start /B /MIN "" "A:\Ignas\random\apache\bin\httpd.exe"

if errorlevel 255 goto finish
if errorlevel 1 goto error
goto finish

:stop
cmd.exe /C start "" /MIN call "A:\Ignas\random\killprocess.bat" "httpd.exe"

if not exist "A:\Ignas\random\apache\logs\httpd.pid" GOTO finish
del "A:\Ignas\random\apache\logs\httpd.pid"
goto finish

:error
echo Error starting Apache

:finish
exit
