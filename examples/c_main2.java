public static void main(String[] args) throws Exception {
    Locale defaultLocale = Locale.getDefault(); // default locale
    try {
        Locale.setDefault(Locale.US);

        // test cases
        skipTest();
        findInLineTest();
        // ... another tests

        if (failure) throw new RuntimeException("Failure in the scanning tests.");
        else System.err.println("OKAY: All tests passed.");
    } finally {
        Locale.setDefault(defaultLocale); // restore default
    }
}