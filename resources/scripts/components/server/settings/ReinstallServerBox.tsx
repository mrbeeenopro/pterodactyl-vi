import React, { useEffect, useState } from 'react';
import { ServerContext } from '@/state/server';
import TitledGreyBox from '@/components/elements/TitledGreyBox';
import reinstallServer from '@/api/server/reinstallServer';
import { Actions, useStoreActions } from 'easy-peasy';
import { ApplicationStore } from '@/state';
import { httpErrorToHuman } from '@/api/http';
import tw from 'twin.macro';
import { Button } from '@/components/elements/button/index';
import { Dialog } from '@/components/elements/dialog';

export default () => {
    const uuid = ServerContext.useStoreState((state) => state.server.data!.uuid);
    const [modalVisible, setModalVisible] = useState(false);
    const { addFlash, clearFlashes } = useStoreActions((actions: Actions<ApplicationStore>) => actions.flashes);

    const reinstall = () => {
        clearFlashes('settings');
        reinstallServer(uuid)
            .then(() => {
                addFlash({
                    key: 'settings',
                    type: 'success',
                    message: 'Máy chủ của bạn đã bắt đầu quá trình cài đặt lại.',
                });
            })
            .catch((error) => {
                console.error(error);

                addFlash({ key: 'settings', type: 'error', message: httpErrorToHuman(error) });
            })
            .then(() => setModalVisible(false));
    };

    useEffect(() => {
        clearFlashes();
    }, []);

    return (
        <TitledGreyBox title={'Cài đặt lại máy chủ'} css={tw`relative`}>
            <Dialog.Confirm
                open={modalVisible}
                title={'Xác nhận cài đặt lại máy chủ'}
                confirm={'Có, cài đặt lại máy chủ'}
                onClose={() => setModalVisible(false)}
                onConfirmed={reinstall}
            >
                Máy chủ của bạn sẽ bị dừng và một số tệp có thể bị xóa hoặc sửa đổi trong quá trình này, bạn có chắc
                chắn muốn tiếp tục không?
            </Dialog.Confirm>
            <p css={tw`text-sm`}>
                Việc cài đặt lại máy chủ của bạn sẽ dừng nó, và sau đó chạy lại tập lệnh cài đặt ban đầu.&nbsp;
                <strong css={tw`font-medium`}>
                    Một số tệp có thể bị xóa hoặc sửa đổi trong quá trình này, vui lòng sao lưu dữ liệu của bạn trước
                    khi tiếp tục.
                </strong>
            </p>
            <div css={tw`mt-6 text-right`}>
                <Button.Danger variant={Button.Variants.Secondary} onClick={() => setModalVisible(true)}>
                    Cài đặt lại máy chủ
                </Button.Danger>
            </div>
        </TitledGreyBox>
    );
};
