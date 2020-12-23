@Test(op = Operation.SMALLER)
public static boolean testSmaller1(int a, int b) { return compare1(a, b) == -1; }

@Test(op = Operation.SMALLER)
public static boolean testSmaller2(int a, int b) { return compare1(a, b) < 0; }

public static void main(String[] args) throws Exception {
    Random rand = Utils.getRandomInstance();
    for (int i = 0; i < 20_000; ++i) {
        int low = rand.nextInt(); int high = rand.nextInt();

        for (Method m : TestTrichotomyExpressions.class.getMethods()) {
          if (m.isAnnotationPresent(Test.class)) {
            Operation op = m.getAnnotation(Test.class).op();
            boolean result = (boolean)m.invoke(null, low, low);
            Asserts.assertEquals(result, (op == Operation.EQUAL 
              || op == Operation.SMALLER_EQUAL 
              || op == Operation.GREATER_EQUAL) ? true : false, m + " failed");
            result = (boolean)m.invoke(null, low, high);
            Asserts.assertEquals(result, (op == Operation.SMALLER 
              || op == Operation.SMALLER_EQUAL) ? true : false, m + " failed");
            result = (boolean)m.invoke(null, high, low);
            Asserts.assertEquals(result, (op == Operation.GREATER 
              || op == Operation.GREATER_EQUAL) ? true : false, m + " failed");
          }
        }
    }
}