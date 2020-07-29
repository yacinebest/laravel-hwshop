<?php
namespace App\Traits\Base;

trait StringToModelNameTraits{
    function convertVariableToModelName($modelName='',$nameSpace='App\\Models')
    {
        if (empty($nameSpace) || is_null($nameSpace) || $nameSpace === "")
        {
           $modelNameWithNameSpace = "App\\Models".'\\'.$modelName;
            return app($modelNameWithNameSpace);
        }

        if (is_array($nameSpace))
        {
            $nameSpace = implode('\\', $nameSpace);
            $modelNameWithNameSpace = $nameSpace.'\\'.$modelName;
            return app($modelNameWithNameSpace);
        }elseif (!is_array($nameSpace))
        {
            $modelNameWithNameSpace = $nameSpace.'\\'.$modelName;
            return app($modelNameWithNameSpace);
        }
    }
}
