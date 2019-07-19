<?php

define ('HMAC_SHA256', 'sha256');
define ('SECRET_KEY', '36bc0d6c512940f9a4c6c28cdea44646122c83d071d24d86b324e40db22b58930d526fbae7744f34b9fe31b0734d3b1f8cc8f85098db48e19313f73002ee428dab4773cc7a584c4f8ee0933b937d5158db989b9bdd2a4aa09fca90e61583a67c55b074f59b1d4352a5837384694623a2d75e6ffc91a84ebcaabd32dd462b926f');

function sign ($params) {
  return signData(buildDataToSign($params), SECRET_KEY);
}

function signData($data, $secretKey) {
    return base64_encode(hash_hmac('sha256', $data, $secretKey, true));
}

function buildDataToSign($params) {
        $signedFieldNames = explode(",",$params["signed_field_names"]);
        foreach ($signedFieldNames as &$field) {
           $dataToSign[] = $field . "=" . $params[$field];
        }
        return commaSeparate($dataToSign);
}

function commaSeparate ($dataToSign) {
    return implode(",",$dataToSign);
}

?>
