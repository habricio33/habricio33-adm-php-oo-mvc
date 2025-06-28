<?php

namespace App\adms\Helpers;

use Monolog\Level;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;


/**
 * Gerar log
 * 
 * @author Fabricio <fabricio.cecatto1@gmail.com>
 *  - DEBUG (100): Informação de depuração.
 *  - INFO (200): Eventos interessantes. Por exemplo: um usuário realizou o login ou logs de SQL.
 *  - NOTICE (250): Eventos normais, mas significantes.
 *  - WARNING (300): Ocorrências excepcionais, mas que não são erros. Por exemplo: Uso de APIs descontinuadas, uso inadequado de uma API. Em geral coisas que não estão erradas mas precisam de atenção.
 *  - ERROR (400): Erros de tempo de execução que não requerem ação imediata, mas que devem ser logados e monitorados.
 *  - CRITICAL (500): Condições criticas. Por exemplo: Um componente da aplicação não está disponível, uma exceção não esperada ocorreu.
 *  - ALERT (550): Uma ação imediata deve ser tomada. Exemplo: O sistema caiu, o banco de dados está indisponível , etc. Deve disparar um alerta para o responsável tomar providencia o mais rápido possível.
 *  - EMERGENCY (600): Emergência: O sistema está inutilizável.
 */
class GenerateLog
{
    public static function generateLog(string $level, string $message, array|null $content): void
    {
         // Criar o logger
        $log = new Logger('name');

        // Obter a data atual no formato "ddmmyyyy"
        $nameFileLog = date('dmY') . ".log";

        // Criar o caminho dos logs
        $filePath= 'logs/' . $nameFileLog;

        // Verificar se o arquivo existe
        if(!file_exists($filePath)){

            // Abrir o arquivo para escrita
            $fileOpen = fopen($filePath, 'w');

            // Fechar o arquivo
            fclose($fileOpen);
        }

        // Utilizar StreamHandler para salvar os log no arquivo
        $log->pushHandler(new StreamHandler($filePath, Level::Debug));

        // Salvar o log no arquivo
        $log->$level($message, $content);
    }
}

// create a log channel
$log = new Logger('name');
$log->pushHandler(new StreamHandler('path/to/your.log', Level::Warning));

// add records to the log
$log->warning('Foo');
$log->error('Bar');