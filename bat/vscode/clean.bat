@echo off
chcp 65001 > nul
setlocal enabledelayedexpansion

REM ��ȡϵͳ�û���
for %%a in ("%userprofile%") do set "YourUsername=%%~nxa"
echo ���ڻ�ȡϵͳ�û���: %YourUsername%

REM ���� .vscode Ŀ¼
set "vscodePath=%userprofile%\.vscode"
if exist "!vscodePath!" (
echo ���ڼ�� .vscode �ļ���
echo ��⵽ .vscode �ļ��У���ʼ����
rmdir /s /q "!vscodePath!"
echo .vscode �ļ���������
) else (
echo δ�ҵ� .vscode �ļ��С���������
)

echo

REM ���� AppData/Roaming/Code Ŀ¼
set "codePath=%userprofile%\AppData\Roaming\Code"
if exist "!codePath!" (
echo ���ڼ�� Code �ļ���
echo ��⵽ Code �ļ��У���ʼ����
rmdir /s /q "!codePath!"
echo Code �ļ���������
) else (
echo δ�ҵ� Code �ļ��С���������
)

echo
echo �������
pause