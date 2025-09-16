<?php
// 代码生成时间: 2025-09-17 00:13:32
require_once 'path/to/yii/framework/yii.php';

class BulkFileRenameTool extends CComponent
{
    // 要重命名的文件夹路径
    private $directory;
    // 新的文件名规则
    private $newNamePattern;
    // 重命名计数器
    private $counter;

    public function __construct($directory, $newNamePattern)
    {
        $this->directory = $directory;
        $this->newNamePattern = $newNamePattern;
        $this->counter = 1;
    }

    public function renameFiles()
    {
        if (!is_dir($this->directory)) {
            throw new CException("The directory does not exist.");
        }

        $files = scandir($this->directory);
        foreach ($files as $file) {
            if ($file === '.' || $file === '..') {
                continue;
            }

            $oldPath = $this->directory . DIRECTORY_SEPARATOR . $file;
            $newName = sprintf($this->newNamePattern, $this->counter++);
            $newPath = $this->directory . DIRECTORY_SEPARATOR . $newName;

            if (@rename($oldPath, $newPath)) {
                // 成功重命名
                echo "Renamed '{$oldPath}' to '{$newPath}'
";
            } else {
                // 处理错误
                echo "Error renaming '{$oldPath}' to '{$newPath}'
";
            }
        }
    }
}

// 使用示例
try {
    $tool = new BulkFileRenameTool('/path/to/your/directory', 'new_file_%d.ext');
    $tool->renameFiles();
} catch (CException $e) {
    echo "Error: " . $e->getMessage();
}
