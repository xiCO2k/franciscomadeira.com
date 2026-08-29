<!-- sparkle-sign-warning:
IMPORTANT: This file was signed by Sparkle. Any modifications to this file requires updating signatures in appcasts that reference this file! This will involve re-running generate_appcast or sign_update.
-->
## What's new in 0.6.12

A mono-only plugin no longer freezes Strip or gets turned away. Waves ship a mono and a
stereo build of most things, and connecting the mono one directly to a stereo graph does
not fail — it never returns. Strip now does what a DAW does and wraps it: the signal is
folded to mono for the plugin and spread back afterwards, so `Clarity Vx (m)` runs in a
stereo chain like anything else. The fold is level-matched, measured at 0.00 dB against
the same signal sent straight through.

This is also the first build with secure in-app updates. Strip asks once before checking
periodically, shows what changed, and only installs after approval. The source repository
stays private; the updater sees only signed, notarized release archives.

