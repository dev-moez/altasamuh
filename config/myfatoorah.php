<?php

return [
    /**
     * API Token Key (string)
     * Accepted value:
     * Live Token: https://myfatoorah.readme.io/docs/live-token
     * Test Token: https://myfatoorah.readme.io/docs/test-token
     */
    // Testing 
    // 'api_key' => 'rLtt6JWvbUHDDhsZnfpAhpYk4dxYDQkbcPTyGaKp2TYqQgG7FGZ5Th_WD53Oq8Ebz6A53njUoo1w3pjU1D4vs_ZMqFiz_j0urb_BH9Oq9VZoKFoJEDAbRZepGcQanImyYrry7Kt6MnMdgfG5jn4HngWoRdKduNNyP4kzcp3mRv7x00ahkm9LAK7ZRieg7k1PDAnBIOG3EyVSJ5kK4WLMvYr7sCwHbHcu4A5WwelxYK0GMJy37bNAarSJDFQsJ2ZvJjvMDmfWwDVFEVe_5tOomfVNt6bOg9mexbGjMrnHBnKnZR1vQbBtQieDlQepzTZMuQrSuKn-t5XZM7V6fCW7oP-uXGX-sMOajeX65JOf6XVpk29DP6ro8WTAflCDANC193yof8-f5_EYY-3hXhJj7RBXmizDpneEQDSaSz5sFk0sV5qPcARJ9zGG73vuGFyenjPPmtDtXtpx35A-BVcOSBYVIWe9kndG3nclfefjKEuZ3m4jL9Gg1h2JBvmXSMYiZtp9MR5I6pvbvylU_PP5xJFSjVTIz7IQSjcVGO41npnwIxRXNRxFOdIUHn0tjQ-7LwvEcTXyPsHXcMD8WtgBh-wxR8aKX7WPSsT1O8d8reb2aR7K3rkV3K82K_0OgawImEpwSvp9MNKynEAJQS6ZHe_J_l77652xwPNxMRTMASk1ZsJL',
    // Production
    'api_key' => 'Jn-d9x-JGX2V0D-5xrHyTnek2-D0foH0zqeN8wHSfXEmLINY4BtqVvJckbgt1HKBsdc4XtXOOR_4SLTP6j5YEuW7RIslRR_JT2o_hfo-C2cZZ-EPnHjFZeav3TqjB0AZpiyJyMFXeRHGkx8Rz-oPJ8RL9E9hebzp9aVdwWby4AklvaBEsmY6YevAIQK-GMdpSRC2R9D1OhC0J_4RVZHKXaRB-hoBaXsE81xKpTAqGopFcWhKCseKncrA72ewiy460zgbznJXphTMuqf3uXrweHj6evnwJAnHN4kw3d6HyjmVqsaQ2Xtj_j32AuGdMguRvKwkdhO2ieW8T3es7ZBog7QCdfBSgtQb8o8iIrGpsCyRkCHhk6mrea6zqhmYGYgH3mJ26J8shhwpO1uzGvqaQXUZ_DDKx7kTJR1g1IXWCCuQdMVHrrBzNeJuVHc84S09Zjip2x4LFRdDopL4747Aekw705JDhu5j3TOz0AFwSps7B6sbLa8mpkPAoQUX-7vfkciQ0sJdgxrA0UUDQGoul-QcRhGUKRzaJXf7dxLwokzYSbk02wQ9fPYIQBegTJH6fyx46qfJZh7HB0WMpYT1SM0JtUAnssw7PbVKzwV4PkdFmS7j1ihUZkZMIotaTbfTygD-JAwHsVWMPaD56xE1MLJmOEhK5rqMH6ei7_fSg5_meOerbyGROlCVhPJ2ASOmxdLwnCyeuunyJ3sqbpcnMMoNIgN1j3DsAjNGnxN4pX7cO5M_', // Live
    /**
     * Test Mode (boolean)
     * Accepted value: true for the test mode or false for the live mode
     */
    'test_mode' => false,
    /**
     * Country ISO Code (string)
     * Accepted value: KWT, SAU, ARE, QAT, BHR, OMN, JOD, or EGY.
     */
    'country_iso' => 'KWT',
    /**
     * Save card (boolean)
     * Accepted value: true if you want to enable save card options.
     * You should contact your account manager to enable this feature in your MyFatoorah account as well.
     */
    'save_card' => true,
    /**
     * Webhook secret key (string)
     * Enable webhook on your MyFatoorah account setting then paste the secret key here.
     * The webhook link is: https://{example.com}/myfatoorah/webhook
     */
    'webhook_secret_key' => '',
    /**
     * Register Apple Pay (boolean)
     * Set it to true to show the Apple Pay on the checkout page.
     * First, verify your domain with Apple Pay before you set it to true.
     * You can either follow the steps here: https://docs.myfatoorah.com/docs/apple-pay#verify-your-domain-with-apple-pay or contact the MyFatoorah support team (tech@myfatoorah.com).
     */
    'register_apple_pay' => false
];
