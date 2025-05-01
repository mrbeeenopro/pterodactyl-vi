import React, { useEffect, useState } from 'react';
import { ServerContext } from '@/state/server';
import Modal from '@/components/elements/Modal';
import tw from 'twin.macro';
import Button from '@/components/elements/Button';
import FlashMessageRender from '@/components/FlashMessageRender';
import useFlash from '@/plugins/useFlash';
import { SocketEvent } from '@/components/server/events';
import { useStoreState } from 'easy-peasy';

const SteamDiskSpaceFeature = () => {
    const [visible, setVisible] = useState(false);
    const [loading] = useState(false);

    const status = ServerContext.useStoreState((state) => state.status.value);
    const { clearFlashes } = useFlash();
    const { connected, instance } = ServerContext.useStoreState((state) => state.socket);
    const isAdmin = useStoreState((state) => state.user.data!.rootAdmin);

    useEffect(() => {
        if (!connected || !instance || status === 'running') return;

        const errors = ['steamcmd cần 250mb dung lượng trống để cập nhật', '0x202 sau khi thực hiện công việc cập nhật'];

        const listener = (line: string) => {
            if (errors.some((p) => line.toLowerCase().includes(p))) {
                setVisible(true);
            }
        };

        instance.addListener(SocketEvent.CONSOLE_OUTPUT, listener);

        return () => {
            instance.removeListener(SocketEvent.CONSOLE_OUTPUT, listener);
        };
    }, [connected, instance, status]);

    useEffect(() => {
        clearFlashes('feature:steamDiskSpace');
    }, []);

    return (
        <Modal
            visible={visible}
            onDismissed={() => setVisible(false)}
            closeOnBackground={false}
            showSpinnerOverlay={loading}
        >
            <FlashMessageRender key={'feature:steamDiskSpace'} css={tw`mb-4`} />
            {isAdmin ? (
                <>
                    <div css={tw`mt-4 sm:flex items-center`}>
                        <h2 css={tw`text-2xl mb-4 text-neutral-100 `}>Hết dung lượng trống...</h2>
                    </div>
                    <p css={tw`mt-4`}>
                        Máy chủ này đã hết dung lượng trống và không thể hoàn thành quá trình cài đặt hoặc cập nhật.
                    </p>
                    <p css={tw`mt-4`}>
                        Đảm bảo máy chủ có đủ dung lượng trống bằng cách gõ{' '}
                        <code css={tw`font-mono bg-neutral-900 rounded py-1 px-2`}>df -h</code> trên máy chủ lưu trữ
                        máy chủ này. Xóa tệp hoặc tăng dung lượng trống để giải quyết vấn đề.
                    </p>
                    <div css={tw`mt-8 sm:flex items-center justify-end`}>
                        <Button onClick={() => setVisible(false)} css={tw`w-full sm:w-auto border-transparent`}>
                            Đóng
                        </Button>
                    </div>
                </>
            ) : (
                <>
                    <div css={tw`mt-4 sm:flex items-center`}>
                        <h2 css={tw`text-2xl mb-4 text-neutral-100`}>Hết dung lượng trống...</h2>
                    </div>
                    <p css={tw`mt-4`}>
                        Máy chủ này đã hết dung lượng trống và không thể hoàn thành quá trình cài đặt hoặc cập nhật. Vui
                        lòng liên hệ với quản trị viên và thông báo cho họ về vấn đề dung lượng.
                    </p>
                    <div css={tw`mt-8 sm:flex items-center justify-end`}>
                        <Button onClick={() => setVisible(false)} css={tw`w-full sm:w-auto border-transparent`}>
                            Đóng
                        </Button>
                    </div>
                </>
            )}
        </Modal>
    );
};

export default SteamDiskSpaceFeature;
