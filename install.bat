@echo off
setlocal EnableDelayedExpansion

set "FOLDERNAME=user-auth"
set "BASEPATH=%~dp0"
set "SOURCE=%BASEPATH%%FOLDERNAME%"

echo.
echo Suche nach einem Ordner namens "htdocs" auf Laufwerk C:...

:: Suche nach einem Ordner namens "htdocs"
for /d /r "C:\" %%D in (htdocs) do (
    if exist "%%D" (
        set "HTDOCS=%%D"
        goto found
    )
)

echo Kein Ordner namens "htdocs" auf C:\ gefunden.
pause
exit /b

:found
echo htdocs gefunden unter: !HTDOCS!
set "DEST=!HTDOCS!\%FOLDERNAME%"

:: Falls Ziel bereits existiert, löschen
if exist "!DEST!" (
    echo Entferne alten Ordner: !DEST!
    rmdir /s /q "!DEST!"
)

:: Kopieren
echo Kopiere %SOURCE% nach !DEST! ...
xcopy "%SOURCE%" "!DEST!" /E /I /Y >nul

echo.
echo Kopiervorgang abgeschlossen.
echo Rufe im Browser auf: http://localhost/%FOLDERNAME%
pause
