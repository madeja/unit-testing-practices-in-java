public static void main(String args[]) throws Exception {
    try {
        String type = "BI_RLE4";
        doTest(type, ImageWriteParam.MODE_EXPLICIT);

        type = "BI_RLE8";
        doTest(type, ImageWriteParam.MODE_EXPLICIT);
    } catch (IOException e) {
        e.printStackTrace();
        throw new RuntimeException("Unexpected exception. Test failed");
    }
}

private static void doTest(String compressionType, int compressionMode) throws IOException
{
    // create UUT object with different compressionType and compressionMode
    // ... then test the functionality according to UUT
}