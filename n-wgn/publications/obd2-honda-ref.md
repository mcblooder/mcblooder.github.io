# OBD2 Honda ref.

## 222301 — CVT / transmission

| Field | Packet bytes / bits | Formula | Unit | Profiles |
| --- | --- | --- | --- | --- |
| ATF temperature var.3 | AA (offset 26) | `AA-40` | °C | P0369, P0519, P0794, P1252 |
| CVT RPM Pre-TC | H, I | `H*256+I` | rpm | P0794, P1252 |
| CVT TC Lock | H, I, J, K | `ABS((H*256+I)/(J*256+K)-1)` | — | P0794, P1252 |
| CVT TC Ratio | H, I, J, K | `(H*256+I)/(J*256+K)` | — | P0794, P1252 |
| CVT RPM Post TC | J, K | `J*256+K` | rpm | P0794, P1252 |
| CVT Gear Ratio | J, K, L, M | `(L*256+M)/(J*256+K)` | — | P0794, P1252 |
| CVT Output RPM | L, M | `L*256+M` | rpm | P0794, P1252 |

## 222201 — ATF temperature — variant 1

| Field | Packet bytes / bits | Formula | Unit | Profiles |
| --- | --- | --- | --- | --- |
| ATF temperature var.1 | AA (offset 26) | `AA-40` | °C | P0794, P1252 |

## 222610 — Engine live data

| Field | Packet bytes / bits | Formula | Unit | Profiles |
| --- | --- | --- | --- | --- |
| EGR valve voltage | AA | `AA*5/255` | V | P0369 |
| EGR commanded opening % | AB | `AB` | % | P0369 |
| EGR actual opening % | AC, AD | `(AC*256+AD)/255` | % | P0369 |
| EGR actual opening gap | AC, AD | `(AC*256+AD)/5100` | mm | P0369 |
| Mass air flow (MAF) | AI, AJ | `(AI*256+AJ)*0.01` | g/s | P0369 |
| Radiator coolant temperature | AM | `AM-40` | °C | P0369 |
| Engine oil pressure sensor | AS, AT | `(AS*256+AT)*0.01` | bar | P0369 |
| Engine speed | G, H | `(G*256+H)*0.25` | rpm | P0369 |
| Engine coolant temperature | L | `L-40` | °C | P0369 |
| Intake air temperature | N | `N-40` | °C | P0369 |
| Vehicle speed (OBD2-CAN) | S | `S` | — | P0369 |
| Ignition timing advance | V | `V*0.5-64` | ° | P0369 |
| Battery voltage | W | `W*0.1` | V | P0369 |
| Injector pulse width | Y, Z | `(Y*256+Z)*0.005` | ms | P0369 |

## 222611 — Air–fuel ratio

| Field | Packet bytes / bits | Formula | Unit | Profiles |
| --- | --- | --- | --- | --- |
| Air–fuel ratio (wideband) | I, J | `(I*256+J)*29.40/65535` | — | P0369 |

## 222612 — Gear, throttle and VTEC

| Field | Packet bytes / bits | Formula | Unit | Profiles |
| --- | --- | --- | --- | --- |
| Gear | AS | `AS` | — | P0369 |
| Throttle position | O, P | `(O*256+P)*0.005` | ° | P0369 |
| VTEC commanded | V bit 0 | `(V >> 0) & 1` | — | P0369 |
| VTEC actual | X bit 0 | `(X >> 0) & 1` | — | P0369 |

## 222661 — Cooling fans

| Field | Packet bytes / bits | Formula | Unit | Profiles |
| --- | --- | --- | --- | --- |
| Cooling fan – high speed | AU (offset 46) | `(AU)/16` | — | P0369 |
| Cooling fan – low speed | AU (offset 46) | `(AU)/8` | — | P0369 |

## 222662 — Cam timing, knock and catalyst

| Field | Packet bytes / bits | Formula | Unit | Profiles |
| --- | --- | --- | --- | --- |
| VTC commanded cam angle | AD | `AD*0.5-20` | ° | P0369 |
| VTC+CMP cam angle with VTC | AE | `AE*0.5` | ° | P0369 |
| VTC actual cam angle | AE, AF | `(AE-AF)*0.5` | ° | P0369 |
| CMP cam angle at VTC=0 (chain) | AF | `AF*0.5` | ° | P0369 |
| VTC actual cam angle + | AG, AH | `(AG*256+AH)*0.1` | ° | P0369 |
| Spark retard for knock prevention | I | `I*0.5` | ° | P0369 |
| Spark retard total | I, K | `I*0.5*K*1.99/255` | ° | P0369 |
| Knock control | K | `K*1.99/255` | — | P0369 |
| Catalyst temperature (calculated) | M, N | `(M*256+N)*0.1-40` | °C | P0369 |

## 222663 — Total misfires

| Field | Packet bytes / bits | Formula | Unit | Profiles |
| --- | --- | --- | --- | --- |
| Misfires total (all cylinders) | G, H | `G*256+H` | — | P0369 |

## 222668 — Throttle and accelerator

| Field | Packet bytes / bits | Formula | Unit | Profiles |
| --- | --- | --- | --- | --- |
| Throttle body contamination (estimated) | AT | `AT*100/255` | % | P0369 |
| Accelerator pedal position A | H, I | `(H*256+I)/255` | % | P0369 |
| Accelerator pedal position B | J, K | `(J*256+K)/255` | % | P0369 |

## 22266C — Cylinder misfires

| Field | Packet bytes / bits | Formula | Unit | Profiles |
| --- | --- | --- | --- | --- |
| Misfire (final) cylinder 1 | G | `G` | — | P0369 |
| Misfire (final) cylinder 2 | H | `H` | — | P0369 |
| Misfire (final) cylinder 3 | I (offset 8) | `I` | — | P0369 |
| Misfire (final) cylinder 4 | J (offset 9) | `J` | — | P0369 |

## 22266D — Air–fuel sensor heater

| Field | Packet bytes / bits | Formula | Unit | Profiles |
| --- | --- | --- | --- | --- |
| Air–fuel sensor heater | J | `J*0.5` | % | P0369 |

## 222681 — Battery current

| Field | Packet bytes / bits | Formula | Unit | Profiles |
| --- | --- | --- | --- | --- |
| Battery charge/discharge current | I, J | `ShortSigned(I,J)*0.01` | A | P0369 |

## 223083 — ATF temperature — variant 2

| Field | Packet bytes / bits | Formula | Unit | Profiles |
| --- | --- | --- | --- | --- |
| ATF temperature var.2 | O (offset 14) | `O-40` | °C | P0794, P1252 |
