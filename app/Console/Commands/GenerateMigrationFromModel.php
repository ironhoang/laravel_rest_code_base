<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class GenerateMigrationFromModel extends Command
{
    protected $signature = 'generate:migration-from-model {model}';
    protected $description = 'Generate migration file from model annotations';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $modelName = $this->argument('model');
        $modelClass = "App\\Models\\$modelName";

        // Kiểm tra nếu model tồn tại
        if (!class_exists($modelClass)) {
            $this->error("Model $modelName không tồn tại.");
            return;
        }

        // Đọc nội dung file model
        $reflection = new \ReflectionClass($modelClass);
        $filePath = $reflection->getFileName();
        $fileContents = File::get($filePath);

        // Phân tích annotation
        preg_match_all('/@property\s+([a-zA-Z0-9_]+)\s+\$([a-zA-Z0-9_]+)/', $fileContents, $matches);

        // Kiểm tra nếu không có annotation nào
        if (empty($matches[0])) {
            $this->error("Không tìm thấy annotation @property trong model.");
            return;
        }

        // Tạo migration
        $migrationName = "create_" . Str::snake($modelName) . "_table";
        $migrationFileName = date('Y_m_d_His') . '_' . $migrationName . '.php';
        $migrationPath = database_path('migrations') . '/' . $migrationFileName;

        // Tạo migration file
        $migrationTemplate = $this->getMigrationTemplate($modelName, $matches);

        File::put($migrationPath, $migrationTemplate);

        $this->info("Migration đã được tạo tại $migrationPath.");
    }

    /**
     * Tạo template migration từ thông tin model.
     *
     * @param  string  $modelName
     * @param  array   $matches
     * @return string
     */
    private function getMigrationTemplate($modelName, $matches)
    {
        $tableName = Str::snake($modelName);
        $columns = '';

        foreach ($matches[1] as $index => $type) {
            $columnName = $matches[2][$index];
            $columns .= "\$table->$type('$columnName');\n            ";
        }

        return "<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create" . Str::studly($modelName) . "Table extends Migration
{
    public function up()
    {
        Schema::create('$tableName', function (Blueprint \$table) {
            \$table->id();
            $columns
            \$table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('$tableName');
    }
}
";
    }
}
