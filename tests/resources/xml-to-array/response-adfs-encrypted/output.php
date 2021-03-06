<?php
return array (
    '__t' => 'samlp:Response',
    '_ID' => '_6d639117-cc31-45d8-b61d-966c9722ad14',
    '_Version' => '2.0',
    '_IssueInstant' => '2013-01-29T11:42:52.085Z',
    '_Destination' => 'https://engine.acc.surfconext.nl/authentication/sp/consume-assertion',
    '_Consent' => 'urn:oasis:names:tc:SAML:2.0:consent:unspecified',
    '_InResponseTo' => 'CORTObfb474871de044c619e09573e3cd120dfd8151b7',
    'saml:Issuer' =>
    array (
        '__v' => 'http://adfs2.aai.surfnet.nl/adfs/services/trust',
    ),
    'samlp:Status' =>
    array (
        'samlp:StatusCode' =>
        array (
            '_Value' => 'urn:oasis:names:tc:SAML:2.0:status:Success',
        ),
    ),
    'saml:EncryptedAssertion' =>
    array (
        'xenc:EncryptedData' =>
        array (
            '_Type' => 'http://www.w3.org/2001/04/xmlenc#Element',
            'xenc:EncryptionMethod' =>
            array (
                0 =>
                array (
                    '_Algorithm' => 'http://www.w3.org/2001/04/xmlenc#aes256-cbc',
                ),
            ),
            'ds:KeyInfo' =>
            array (
                'xenc:EncryptedKey' =>
                array (
                    0 =>
                    array (
                        'xenc:EncryptionMethod' =>
                        array (
                            0 =>
                            array (
                                '_Algorithm' => 'http://www.w3.org/2001/04/xmlenc#rsa-oaep-mgf1p',
                                'ds:DigestMethod' =>
                                array (
                                    '_Algorithm' => 'http://www.w3.org/2000/09/xmldsig#sha1',
                                ),
                            ),
                        ),
                        'ds:KeyInfo' =>
                        array (
                            'ds:X509Data' =>
                            array (
                                0 =>
                                array (
                                    'ds:X509IssuerSerial' =>
                                    array (
                                        0 =>
                                        array (
                                            'ds:X509IssuerName' =>
                                            array (
                                                0 =>
                                                array (
                                                    '__v' => 'E=surfconext-beheer@surfnet.nl, CN=SURFconext-test, OU=Collaboration Services, O=SURFnet BV - The Netherlands, L=Utrecht, S=Utrecht, C=NL',
                                                ),
                                            ),
                                            'ds:X509SerialNumber' =>
                                            array (
                                                0 =>
                                                array (
                                                    '__v' => '12460363969923873974',
                                                ),
                                            ),
                                        ),
                                    ),
                                ),
                            ),
                        ),
                        'xenc:CipherData' =>
                        array (
                            0 =>
                            array (
                                'xenc:CipherValue' =>
                                array (
                                    0 =>
                                    array (
                                        '__v' => 'uYuytnz1Kw+ROkhxIXgCrNlb9wYxWUm6sCUQRcZkQh1lWSltqGgLyRHUKTta9e3KCHCfunEmXMcg285X5wqLQDojXYZzuilHNum/hBd6XOkSRRC+CW1TNW+kh6/qTkqNEabzMhIVPHgQddZBeHb2RLIt0ZT05D9miqwsT2gzB6hPwWZyx0z2Xzkxw0aPSn6pYyLVPNdbq0WRcPMMb+c9AB9ZH/dF44xj4a1/XhwCflhuZ8ynvfJwdsqX+rceXXhiOS3j9zJYqLSjyfTUR5DCpozilf/PI7i2DImOl1/4RFiYKe2brj8UDj8yu+OW90NYFRoDGv3EMUPaFz3RYb5rXQ==',
                                    ),
                                ),
                            ),
                        ),
                    ),
                ),
            ),
            'xenc:CipherData' =>
            array (
                0 =>
                array (
                    'xenc:CipherValue' =>
                    array (
                        0 =>
                        array (
                            '__v' => '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',
                        ),
                    ),
                ),
            ),
        ),
    ),
);