# Automating Test Case Identification in Open Source Projects on GitHub
This project is part of the scientific paper **Automating Test Case Identification in Open Source Projects on GitHub**. 

## Automated analysis
For automated analysis can be used [AnalyzeProjectCommand.php](./AnalyzeProjectCommand.php) that can be imported as [Laravel command](https://laravel.com/docs/artisan) and executed via `php artisan projects:analyse`.

## Results

### Correlation of the word "test" and number of test cases 
The full correlation analysis results are presented in the following figure. 
![correlation-boxplot](<./correlation-boxplot.png>)

### Revealed testing practices

1. [Master test](examples/c_masterTest.java) - Example of *Master test* type in the [westnordost/StreetComplete](https://github.com/streetcomplete/StreetComplete) repository (*JUnit4*).
2. Reverse proxy test:
    - [By method name](examples/c_reverseProxyMethod.java) - Example of *Reverse proxy test* type in the [JetBrains/intellij-community](https://github.com/JetBrains/intellij-community) repository (*JUnit3*) using the result evaluation via method name.
    - [By internal object state](examples/c_reverseProxyObject.java) - Example of *Reverse proxy test* type in the [openjdk/client](https://github.com/openjdk/client) repository (*JUnit3*) using the result evaluation via internal state of the object.
3. [Multiple test  execution](examples/c_multipleExecution.java) - Example of *Multiple test execution* in the [jsfunit/jsfunit](https://github.com/jsfunit/jsfunit) repository (*JUnit3*).
4. [Customized testing solution](examples/c_main1.java) - Example of customized testing solution using `@Test` annotation in [openjdk/client](https://github.com/openjdk/client) repository.

## Acknowledgements
This work was supported by project VEGA No. 1/0762/19: Interactive pattern-driven language development.