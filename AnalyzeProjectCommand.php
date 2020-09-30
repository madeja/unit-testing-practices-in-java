<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

/**
 * This file can be imported into Laravel Framework as an console command
 *
 * @author Matej Madeja
 * @version 1.0
 */
class AnalyzeProjectCommand extends Command
{
    /**
     * Projects for the analysis.
     *
     * @var string
     */
    private $projects = [
        'openjdk/client' => [
            'type' => self::TYPE_FILENAME,
            'fwkImport' => null,
        ],
        'SpoonLabs/astor' => [
            'type' => self::TYPE_FILENAME,
            'fwkImport' => null,
        ],
        'apache/camel' => [
            'type' => self::TYPE_FILENAME,
            'fwkImport' => null,
        ],
        'apache/netbeans' => [
            'type' => self::TYPE_FILENAME,
            'fwkImport' => null,
        ],
        'JetBrains/intellij-community' => [
            'type' => self::TYPE_CONTENT,
            'fwkImport' => null,
        ],
//        'SpoonLabs/astor' => [
//            'type' => self::TYPE_CONTENT,
//            'fwkImport' => null,
//        ],
        'corretto/corretto-8' => [
            'type' => self::TYPE_CONTENT,
            'fwkImport' => null,
        ],
        'aws/aws-sdk-java' => [
            'type' => self::TYPE_CONTENT,
            'fwkImport' => null,
        ],
        'wildfly/wildfly' => [
            'type' => self::TYPE_CONTENT,
            'fwkImport' => 'org.jboss.arquillian',
        ],
        'eclipse-ee4j/cdi-tck' => [
            'type' => self::TYPE_CONTENT,
            'fwkImport' => 'org.jboss.arquillian',
        ],
        'resteasy/Resteasy' => [
            'type' => self::TYPE_CONTENT,
            'fwkImport' => 'org.jboss.arquillian',
        ],
        'keycloak/keycloak' => [
            'type' => self::TYPE_CONTENT,
            'fwkImport' => 'org.jboss.arquillian',
        ],
        'jsfunit/jsfunit' => [
            'type' => self::TYPE_CONTENT,
            'fwkImport' => 'org.apache.cactus',
        ],
        'bleathem/mojarra' => [
            'type' => self::TYPE_CONTENT,
            'fwkImport' => 'org.apache.cactus',
        ],
        'topcoder-platform/tc-website-master' => [
            'type' => self::TYPE_CONTENT,
            'fwkImport' => 'org.apache.cactus',
        ],
        'apache/hadoop-hdfs' => [
            'type' => self::TYPE_CONTENT,
            'fwkImport' => 'org.apache.cactus',
        ],
        'zanata/zanata-platform' => [
            'type' => self::TYPE_CONTENT,
            'fwkImport' => 'org.dbunit',
        ],
        'B3Partners/brmo' => [
            'type' => self::TYPE_CONTENT,
            'fwkImport' => 'org.dbunit',
        ],
        'gilbertoca/construtor' => [
            'type' => self::TYPE_CONTENT,
            'fwkImport' => 'org.dbunit',
        ],
        'sculptor/sculptor' => [
            'type' => self::TYPE_CONTENT,
            'fwkImport' => 'org.dbunit',
        ],
        'geotools/geotools' => [
            'type' => self::TYPE_CONTENT,
            'fwkImport' => 'net.sourceforge.groboutils',
        ],
        'notoriousre-i-d/ce-packager' => [
            'type' => self::TYPE_CONTENT,
            'fwkImport' => 'net.sourceforge.groboutils',
        ],
        'tliron/prudence' => [
            'type' => self::TYPE_CONTENT,
            'fwkImport' => 'net.sourceforge.groboutils',
        ],
        'MichaelKohler/P2' => [
            'type' => self::TYPE_CONTENT,
            'fwkImport' => 'ch.unibe.jexample',
        ],
        'akuhn/codemap' => [
            'type' => self::TYPE_CONTENT,
            'fwkImport' => 'ch.unibe.jexample',
        ],
        'wprogLK/TowerDefenceANTS' => [
            'type' => self::TYPE_CONTENT,
            'fwkImport' => 'ch.unibe.jexample',
        ],
        'rbhamra/Jboss-Files' => [
            'type' => self::TYPE_CONTENT,
            'fwkImport' => 'de.akquinet.jbosscc.needle',
        ],
        'akquinet/mobile-blog' => [
            'type' => self::TYPE_CONTENT,
            'fwkImport' => 'de.akquinet.jbosscc.needle',
        ],
        's-case/s-case' => [
            'type' => self::TYPE_CONTENT,
            'fwkImport' => 'de.akquinet.jbosscc.needle',
        ],
        'dbarton-uk/population-pie' => [
            'type' => self::TYPE_CONTENT,
            'fwkImport' => 'de.akquinet.jbosscc.needle',
        ],
        'abarhub/rss' => [
            'type' => self::TYPE_CONTENT,
            'fwkImport' => 'com.openpojo',
        ],
        'BRUCELLA2/Prescriptions-Scolaires' => [
            'type' => self::TYPE_CONTENT,
            'fwkImport' => 'com.openpojo',
        ],
        'jpmorganchase/tessera' => [
            'type' => self::TYPE_CONTENT,
            'fwkImport' => 'com.openpojo',
        ],
        'tensorics/tensorics-core' => [
            'type' => self::TYPE_CONTENT,
            'fwkImport' => 'com.openpojo',
        ],
        'orange-cloudfoundry/static-creds-broker' => [
            'type' => self::TYPE_CONTENT,
            'fwkImport' => 'com.tngtech.jgiven',
        ],
        'eclipse/sw360' => [
            'type' => self::TYPE_CONTENT,
            'fwkImport' => 'com.tngtech.jgiven',
        ],
        'Orchaldir/FantasyWorldSimulation' => [
            'type' => self::TYPE_CONTENT,
            'fwkImport' => 'com.tngtech.jgiven',
        ],
        'kodokojo/docker-image-manager' => [
            'type' => self::TYPE_CONTENT,
            'fwkImport' => 'com.tngtech.jgiven',
        ],
    ];

    /**
     * Types of search.
     *
     * @var string
     */
    const TYPE_CONTENT = 'content';
    const TYPE_FILENAME = 'filename';

    /**
     * Output file name.
     *
     * @var string
     */
    private $fileTitle;

    /**
     * The name of currently processing project.
     *
     * @var string
     */
    private $projectName;

    /**
     * The import of currently processing project framework.
     *
     * @var string
     */
    private $fwkImport;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'projects:analyse';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Analyze all project files containing "test" in the filename or in the file content';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $results = [];
        foreach ($this->projects as $this->projectName => $data) {
            $type = $data['type'];
            $this->fwkImport = $data['fwkImport'];
            $content = [];

            // particular project was saved in a directory using pattern "<PROJECT_OWNER>__<PROJECT_NAME>", so "/" is replaced with "__"
            $projectWithoutSlash = str_replace('/', '__', $this->projectName);
            $this->fileTitle = $type.'-'.($this->fwkImport ? $this->fwkImport.'-' : '').$projectWithoutSlash;

            // get important paths
            $projectsPath = app_path().'/../../../projects/';
            $currentProjectPath = $projectsPath.$projectWithoutSlash.'/';

            // if project not exists, clone from git
            if (!File::exists($currentProjectPath)){
                $this->info('Cloning project '.$this->projectName);
                exec('cd '.$projectsPath.'; git clone https://github.com/'.$this->projectName.'.git '.$projectWithoutSlash, $output, $return_var);
            }

            // revert project to timestemp of download metadata
            $this->info('Fetching project meta from db.');
            // get row from database
            $projectMeta = DB::table('project_metas')->where('full_name', $this->projectName)->first();

            // get default branch name
            exec('cd '.$currentProjectPath.'; git symbolic-ref refs/remotes/origin/HEAD | sed \'s@^refs/remotes/origin/@@\'', $branch, $return_var);
            if ($return_var != 0){
                throw new \Exception('An error occurred while fetching default branch name.');
            }
            $branch = $branch[0];

            // checkout to time of GitHub data fetch datetime
            exec('cd '.$currentProjectPath.'; git checkout `git rev-list -n 1 --before="'.$projectMeta->created_at.'" '.$branch.'`', $output, $return_var);
            if ($return_var != 0){
                throw new \Exception('Project path not exists or is not a git project.');
            }

            // count "test" occurrence in all files and save to file for future runs
            $countFile = $this->fileTitle.'-counts.txt';
            if (!File::exists(storage_path('app/'.$countFile))){
                $this->countTestsInContent($currentProjectPath, $countFile);
            }

            // header for output file
            $content['header'] = implode("\t", [
                '#',
                'path',
                'filename',
                'ext',
                'junit3',
                'junit4',
                'testng',
                $this->fwkImport ?? 'framework not defined',
                'predictionFrom',
                'number of real tests (prediction)',
                'includesMain',
                'real number of tests (manual eval.)',
                'notes',
                'annotations',
                'startsWithTest',
                'endsWithTest',
                'publicMethodsInRoot',
                'publicMethods',
                'path contains "test/"',
                'count $ char in the filename',
                'testInContentCount',
            ]);

            $index = 1;
            $this->info('Processing files containing "test" in the content');
            // process counts of "test" in files content
            foreach(file(storage_path('app/'.$countFile)) as $line) {
                $lineParts = explode(':', $line);
                $path = $lineParts[0];
                $count = str_replace(PHP_EOL, '', array_pop($lineParts));

                $result = $this->analyseFile($currentProjectPath, $path, $index);
                if (is_null($result)) continue; // if file was not found, skip

                $content[$path] = implode("\t", $result)."\t".$count;
                $index++;
            }

            // save data to file
            Storage::put($this->fileTitle.'.txt', implode(PHP_EOL, $content));
        }

        $this->info('DONE');
        return;
    }

    /**
     * Count "test" occurence in a project file and save results
     *
     * @param $projectPath
     * @param $outputFile
     */
    private function countTestsInContent(string $projectPath, string $outputFile) : void{
        $output = shell_exec('ag -c --java --kotlin test '.$projectPath);
        Storage::put($outputFile, str_replace($projectPath, '', $output));
    }

    /**
     * Analyze a file
     *
     * @param $projectPath
     * @param $path
     * @param null $index
     * @return array|null
     */
    private function analyseFile(string $projectPath, string $path, ?int $index = null) : ?array{
        // if file does not exists, return null
        try {
            $fileContent = file_get_contents($projectPath.$path);
        } catch (\Exception $e){
            return null;
        }

        // rm oneline comments
        $fileContent = preg_replace('#//.*'.PHP_EOL.'#', PHP_EOL, $fileContent);

        // remove multiline comment start and end tag, when in a sting
        $fileContent = preg_replace('#".*/\*.*"#', '', $fileContent);
        $fileContent = preg_replace('#".*\*/.*"#', '', $fileContent);

        // rm multiline comments
        $fileContent = preg_replace('#/\*.*?\*/#s', '', $fileContent);

        // rm all until first occurence of "class" (testng can annotate by @Test also whole class, we need to count only annotations of methods)
        $fileContentWithoutImports = substr($fileContent, strpos($fileContent, 'class ') ?? 0);

        $pathParts = explode('/', $path);
        $filename = array_pop($pathParts);
        $ext = $this->file_ext($filename);

        // undependent counts
        $counts = [
            'annotations' => preg_match_all("/@Test/", $fileContentWithoutImports ,$match) - preg_match_all("/\".*@Test*/", $fileContentWithoutImports ,$match), // minus string occurrences
            'junit3' => preg_match_all("/import +.*junit\.framework/", $fileContent ,$match),
            'junit4' => preg_match_all("/import +.*org\.junit/", $fileContent ,$match),
            'testng' => preg_match_all("/import +.*org\.testng/", $fileContent ,$match),
            $this->fwkImport => !is_null($this->fwkImport) ? preg_match_all("/import +.*".str_replace('.', '\.', $this->fwkImport)."/", $fileContent ,$match) : '',
        ];

        // extension dependent counts
        switch ($ext){
            case 'java':
            case 'properties':
                $counts['startsWithTest'] = preg_match_all("/public +.*void *.* +[Tt]est.* *\(/", $fileContentWithoutImports ,$match);
                $counts['endsWithTest'] = preg_match_all("/public +.*void *.* +[a-zA-Z$\_]{1}.*Test *\(/", $fileContentWithoutImports ,$match);
                $counts['publicMethods'] = preg_match_all("/public +.*void +.*\(/", $fileContentWithoutImports ,$match);
                $counts['publicMethodsInRoot'] = $this->countPublicMethodInRoot($fileContentWithoutImports, $ext);
                $counts['includesMain'] = preg_match_all("/public +static +void +main.*\(/", $fileContentWithoutImports ,$match) - preg_match_all("/\".*public\s+static\s+void\s+main *\(.*\"/", $fileContentWithoutImports ,$match); // minus string occurences
                break;
            case 'kt':
                $counts['startsWithTest'] = preg_match_all("/ *fun +[`]{0,1}[Tt]est.*[`]{0,1} *\(/", $fileContentWithoutImports ,$match)
                    - preg_match_all("/ *(private|protected|internal) +fun +[`]{0,1}[Tt]est.*[`]{0,1} *\(/", $fileContentWithoutImports ,$match);
                $counts['endsWithTest'] = preg_match_all("/ *fun +[`]{0,1}[a-zA-Z$\_]{1}.*[Tt]est[`]{0,1} *\(/", $fileContentWithoutImports ,$match)
                    - preg_match_all("/ *(private|protected|internal) +fun +[`]{0,1}[a-zA-Z$\_]{1}.*[Tt]est[`]{0,1} *\(/", $fileContentWithoutImports ,$match);
                $counts['publicMethods'] = preg_match_all("/ *fun +.*\(/", $fileContentWithoutImports ,$match)
                    - preg_match_all("/ *(private|protected|internal) +fun +.*\(/", $fileContentWithoutImports ,$match);
                $counts['publicMethodsInRoot'] = $this->countPublicMethodInRoot($fileContentWithoutImports, $ext);
                $counts['includesMain'] = preg_match_all("/fun +main *\(/", $fileContentWithoutImports ,$match); // minus string occurences
                break;
            default:
                $this->error('Unsupported file extension: '.$ext);
                $counts['startsWithTest'] = 0;
                $counts['endsWithTest'] = 0;
                $counts['publicMethods'] = 0;
                $counts['publicMethodsInRoot'] = 0;
                $counts['includesMain'] = 0;
        }

        $predictionFrom = null;
        $nonClassContent = substr($fileContent, 0, strpos($fileContent, 'class '));
        // testng has an special behaviour
        if (preg_match_all("/import.*org\.testng\.annotations\.Test/", $nonClassContent, $match) || preg_match_all("/import.*org\.testng\.annotations\.\*/", $nonClassContent, $match)){

            // if class is annotated, all public methods are considered as tests
            if (substr_count($nonClassContent, '@Test')){
                $numberOfTests = $counts['publicMethodsInRoot'];
                $predictionFrom = 'publicMethodsInRoot';
            }
            // use annotation count if junit @Test annotation is imported and class is not annotated with @Test
            else{
                $numberOfTests = $counts['annotations'];
                $predictionFrom = 'annotations';
            }
        }
        // use annotation count if junit @Test annotation is imported before first class occurrence
        elseif ($counts['junit4']){
            $numberOfTests = $counts['annotations'];
            $predictionFrom = 'annotations';
        }
        // junit3 methods starts with "test"
        elseif ($counts['junit3']){
            $numberOfTests = $counts['startsWithTest'];
            $predictionFrom = 'startsWithTest';
        }
        else{
            if ($counts['startsWithTest'] > 0){
                $numberOfTests = $counts['startsWithTest'];
                $predictionFrom = 'startsWithTest';
            }
            elseif ($counts['annotations'] > 0) {
                $numberOfTests = $counts['annotations'];
                $predictionFrom = 'annotations';
            }
            else{
                $numberOfTests = 0;
                $predictionFrom = 'NULL';
            }
        }

        // apache.cactus can include beginXXX and endXXX, which are also tests
        if (preg_match_all("/import.*".str_replace('.', '\.', "org.apache.cactus/"), $nonClassContent, $match)){

            // in beginXXX there are normally no asserts
            // $numberOfTests += preg_match_all("/public +.*void *.* +begin.* *\(/", $fileContentWithoutImports ,$match);
            // in endXXX normally http response code is checked
            $numberOfTests += preg_match_all("/public +.*void *.* +end.* *\(/", $fileContentWithoutImports ,$match);
            $predictionFrom = 'apache.cactus';
        }

        return [
            $index,
            $path,
            $filename,
            $ext,
            $counts['junit3'],
            $counts['junit4'],
            $counts['testng'],
            $counts[$this->fwkImport],
            $predictionFrom,
            $numberOfTests,
            $counts['includesMain'],
            null,
            null,
            $counts['annotations'],
            $counts['startsWithTest'],
            $counts['endsWithTest'],
            $counts['publicMethodsInRoot'],
            $counts['publicMethods'],
            substr_count($path, 'test/') ? 1 : 0,
            substr_count($filename, '$'),
        ];
    }

    /**
     * Counts public method in first level of a class
     * @param $fileContentWithoutImports
     * @param $ext
     * @return false|int
     */
    private function countPublicMethodInRoot(string $fileContentWithoutImports, string $ext) : int{
        // remove all content of subblocks
        $fileContentWithoutImportsAndMainBlock = substr($fileContentWithoutImports, strpos($fileContentWithoutImports, '{')+1);
        $fileContentWithoutImportsAndMainBlock = substr($fileContentWithoutImportsAndMainBlock, 0, strrpos($fileContentWithoutImportsAndMainBlock, '}'));
        $fileContentWithoutSubblocks = preg_replace('/\{([^\{\}]++|(?R))*\}/', '', $fileContentWithoutImportsAndMainBlock);

        switch ($ext){
            case 'java':
            case 'properties':
                $regex = 'public +.*void +.*\(';
                break;
            case 'kt':
                $regex = ' *fun +.*\(';
        }

        $numberOfTests = preg_match_all("/".$regex."/", $fileContentWithoutSubblocks,$match);

        $except = [
            '@BeforeTest',
            '@AfterTest',
            '@BeforeMethod',
            '@AfterMethod',
        ];
        foreach ($except as $item) {
            $numberOfTests -= preg_match_all("/".$item."\s*".$regex."/", $fileContentWithoutSubblocks,$match);
        }

        if ($ext == 'kt'){
            $numberOfTests -=  preg_match_all("/ *(private|protected|internal) +fun +.*\(/", $fileContentWithoutSubblocks,$match);
        }

        return $numberOfTests;
    }

    /**
     * Get file extension from a filename.
     *
     * @return string
     */
    function file_ext(string $filename) : string {
        return preg_match('/\./', $filename) ? preg_replace('/^.*\./', '', $filename) : '';
    }
}
