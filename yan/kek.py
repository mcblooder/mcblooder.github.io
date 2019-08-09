from wasm.decode import decode_module

with open('1bundle.wasm', 'rb') as raw:
    raw = raw.read()

mod_iter = iter(decode_module(raw))
header, header_data = next(mod_iter)


for cur_sec, cur_sec_data in mod_iter:
    if 'Data' in str(cur_sec_data.get_decoder_meta()['types']['payload']):
        obj = cur_sec_data
print(cur_sec_data.get_decoder_meta())
