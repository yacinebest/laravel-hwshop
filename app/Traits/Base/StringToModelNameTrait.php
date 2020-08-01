<?php
namespace App\Traits\Base;

trait StringToModelNameTrait{
    function convertRepositoryToModelName($modelName='',$nameSpace='App\\Models')
    {
        if($modelName==="")
            $modelName= explode('Repository',class_basename($this))[0] ;

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

    public function explodeNameSpaceModels($path,$nameSpace='App\\Models\\'){
        return explode($nameSpace,$path)[1] ;
    }
}
