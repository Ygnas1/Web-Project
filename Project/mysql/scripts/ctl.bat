@echo off
rem START or STOP Services
rem ----------------------------------
rem Check if argument is STOP or START

if not ""%1"" == ""START"" goto stop


"A:\Ignas\random\mysql\bin\mysqld" --defaults-file="A:\Ignas\random\mysql\bin\my.ini" --standalone
if errorlevel 1 goto error
goto finish

:stop
cmd.exe /C start "" /MIN call "A:\Ignas\random\killprocess.bat" "mysqld.exe"

if not exist "A:\Ignas\random\mysql\data\%computername%.pid" goto finish
echo Delete %computername%.pid ...
del "A:\Ignas\random\mysql\data\%computername%.pid"
goto finish


:error
echo MySQL could not be started

:finish
exit
