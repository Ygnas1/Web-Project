@echo off
rem START or STOP Services
rem ----------------------------------
rem Check if argument is STOP or START

if not ""%1"" == ""START"" goto stop

if exist A:\Ignas\random\hypersonic\scripts\ctl.bat (start /MIN /B A:\Ignas\random\server\hsql-sample-database\scripts\ctl.bat START)
if exist A:\Ignas\random\ingres\scripts\ctl.bat (start /MIN /B A:\Ignas\random\ingres\scripts\ctl.bat START)
if exist A:\Ignas\random\mysql\scripts\ctl.bat (start /MIN /B A:\Ignas\random\mysql\scripts\ctl.bat START)
if exist A:\Ignas\random\postgresql\scripts\ctl.bat (start /MIN /B A:\Ignas\random\postgresql\scripts\ctl.bat START)
if exist A:\Ignas\random\apache\scripts\ctl.bat (start /MIN /B A:\Ignas\random\apache\scripts\ctl.bat START)
if exist A:\Ignas\random\openoffice\scripts\ctl.bat (start /MIN /B A:\Ignas\random\openoffice\scripts\ctl.bat START)
if exist A:\Ignas\random\apache-tomcat\scripts\ctl.bat (start /MIN /B A:\Ignas\random\apache-tomcat\scripts\ctl.bat START)
if exist A:\Ignas\random\resin\scripts\ctl.bat (start /MIN /B A:\Ignas\random\resin\scripts\ctl.bat START)
if exist A:\Ignas\random\jetty\scripts\ctl.bat (start /MIN /B A:\Ignas\random\jetty\scripts\ctl.bat START)
if exist A:\Ignas\random\subversion\scripts\ctl.bat (start /MIN /B A:\Ignas\random\subversion\scripts\ctl.bat START)
rem RUBY_APPLICATION_START
if exist A:\Ignas\random\lucene\scripts\ctl.bat (start /MIN /B A:\Ignas\random\lucene\scripts\ctl.bat START)
if exist A:\Ignas\random\third_application\scripts\ctl.bat (start /MIN /B A:\Ignas\random\third_application\scripts\ctl.bat START)
goto end

:stop
echo "Stopping services ..."
if exist A:\Ignas\random\third_application\scripts\ctl.bat (start /MIN /B A:\Ignas\random\third_application\scripts\ctl.bat STOP)
if exist A:\Ignas\random\lucene\scripts\ctl.bat (start /MIN /B A:\Ignas\random\lucene\scripts\ctl.bat STOP)
rem RUBY_APPLICATION_STOP
if exist A:\Ignas\random\subversion\scripts\ctl.bat (start /MIN /B A:\Ignas\random\subversion\scripts\ctl.bat STOP)
if exist A:\Ignas\random\jetty\scripts\ctl.bat (start /MIN /B A:\Ignas\random\jetty\scripts\ctl.bat STOP)
if exist A:\Ignas\random\hypersonic\scripts\ctl.bat (start /MIN /B A:\Ignas\random\server\hsql-sample-database\scripts\ctl.bat STOP)
if exist A:\Ignas\random\resin\scripts\ctl.bat (start /MIN /B A:\Ignas\random\resin\scripts\ctl.bat STOP)
if exist A:\Ignas\random\apache-tomcat\scripts\ctl.bat (start /MIN /B /WAIT A:\Ignas\random\apache-tomcat\scripts\ctl.bat STOP)
if exist A:\Ignas\random\openoffice\scripts\ctl.bat (start /MIN /B A:\Ignas\random\openoffice\scripts\ctl.bat STOP)
if exist A:\Ignas\random\apache\scripts\ctl.bat (start /MIN /B A:\Ignas\random\apache\scripts\ctl.bat STOP)
if exist A:\Ignas\random\ingres\scripts\ctl.bat (start /MIN /B A:\Ignas\random\ingres\scripts\ctl.bat STOP)
if exist A:\Ignas\random\mysql\scripts\ctl.bat (start /MIN /B A:\Ignas\random\mysql\scripts\ctl.bat STOP)
if exist A:\Ignas\random\postgresql\scripts\ctl.bat (start /MIN /B A:\Ignas\random\postgresql\scripts\ctl.bat STOP)

:end

