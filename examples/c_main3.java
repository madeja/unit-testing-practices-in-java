public class ResourceBundleTest extends RBTestFmwk {
    public static void main(String[] args) throws Exception {
        new ResourceBundleTest().run(args);
    }

    public ResourceBundleTest() { makePropertiesFile(); }

    public void TestResourceBundle() {
        Locale  saveDefault = Locale.getDefault();
        Locale.setDefault(new Locale("fr", "FR"));

        // load up the resource bundle, and make sure we got the right one
        ResourceBundle  bundle = ResourceBundle.getBundle("TestResource");
        if (!bundle.getClass().getName().equals("TestResource_fr"))
            errln("Expected TestResource_fr, got " + bundle.getClass().getName());

        // these resources are defines in ResourceBundle_fr
        String  test1 = bundle.getString("Time");
        if (!test1.equals("Time keeps on slipping..."))
            errln("TestResource_fr returned wrong value for \"Time\":  got " + test1);
    }
}